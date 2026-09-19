# Deploying client sites on EC2 with Cloudflare, Nginx, and Docker

This production setup runs each client as an isolated Docker Compose project. Host Nginx is the only service listening publicly on ports 80 and 443; each Laravel stack listens only on `127.0.0.1` and has its own database, Redis, uploads, network, secrets, and Compose project name.

| Client | Public domain | App port | Compose project | Server directory |
| --- | --- | ---: | --- | --- |
| UniWorld Holidays | `uniworld-holidays.meet-shah.online` | `8081` | `uniworld-holidays` | `/opt/clients/uniworld-holidays` |
| Travel Agency | `travel-agency.meet-shah.online` | `8082` | `travel-agency` | `/opt/clients/travel-agency` |

Do not reuse `.env.production`, Docker volumes, database passwords, or `APP_KEY` between clients.

## 1. EC2 and firewall

Use Ubuntu 24.04 LTS with at least 2 GB RAM and an Elastic IP. In its security group allow TCP `22` only from your administration IP and TCP `80`/`443` from the internet. Do **not** open `3306`, `6379`, `8081`, or `8082`.

```bash
sudo apt update
sudo apt install -y git docker.io docker-compose-v2 nginx
sudo systemctl enable --now docker nginx
sudo usermod -aG docker "$USER"
exit
```

SSH back in, then verify `docker ps`, `docker compose version`, and `sudo nginx -t`.

## 2. Cloudflare DNS and TLS mode

In the Cloudflare DNS dashboard for `meet-shah.online`, create these records pointing to the EC2 Elastic IP:

| Type | Name | Target | Proxy |
| --- | --- | --- | --- |
| A | `uniworld-holidays` | `<EC2_ELASTIC_IP>` | Proxied (orange cloud) |
| A | `travel-agency` | `<EC2_ELASTIC_IP>` | Proxied (orange cloud) |

Set **SSL/TLS → Overview** to **Full (strict)**. Never use Flexible mode: it causes redirect loops and leaves the Cloudflare-to-server connection unencrypted. Enable **Always Use HTTPS** in **SSL/TLS → Edge Certificates**.

## 3. Origin certificate and private key

Cloudflare presents the visitor certificate. Nginx needs an origin certificate for the Cloudflare-to-EC2 connection.

1. In Cloudflare open **SSL/TLS → Origin Server → Create Certificate**.
2. Include `*.meet-shah.online` and `meet-shah.online`; choose a long validity period.
3. Save the certificate and private key in a password manager; Cloudflare shows the private key only once.
4. On EC2, paste them into these exact root-owned files:

```bash
sudo install -d -m 700 /etc/ssl/cloudflare
sudo nano /etc/ssl/cloudflare/meet-shah.online.pem
sudo nano /etc/ssl/cloudflare/meet-shah.online.key
sudo chown root:root /etc/ssl/cloudflare/meet-shah.online.pem /etc/ssl/cloudflare/meet-shah.online.key
sudo chmod 644 /etc/ssl/cloudflare/meet-shah.online.pem
sudo chmod 600 /etc/ssl/cloudflare/meet-shah.online.key
```

The `.pem` contains the certificate; `.key` contains the private key. Keep both outside Git and outside Docker images. If a hostname is DNS-only/grey-cloud, use a Let’s Encrypt wildcard certificate with DNS-01 instead and reference `/etc/letsencrypt/live/meet-shah.online/fullchain.pem` and `privkey.pem` in Nginx. Cloudflare Origin Certificates are not browser-trusted for DNS-only sites.

## 4. Install each client stack

Create one server directory per client and clone the appropriate repository or branch into it:

```bash
sudo mkdir -p /opt/clients
sudo chown "$USER":"$USER" /opt/clients
git clone <your-repository-url> /opt/clients/uniworld-holidays
git clone <your-repository-url> /opt/clients/travel-agency
```

Copy and edit the environment file inside each directory:

```bash
cd /opt/clients/uniworld-holidays && cp .env.production.example .env.production && nano .env.production
cd /opt/clients/travel-agency && cp .env.production.example .env.production && nano .env.production
```

Use these client-specific values, plus unique secure `APP_KEY`, `DB_PASSWORD`, `DB_ROOT_PASSWORD`, and `REDIS_PASSWORD` values:

```dotenv
# /opt/clients/uniworld-holidays/.env.production
APP_NAME="UniWorld Holidays"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://uniworld-holidays.meet-shah.online
COMPOSE_PROJECT_NAME=uniworld-holidays
APP_PORT=127.0.0.1:8081
DB_DATABASE=uniworld_holidays
DB_USERNAME=uniworld_user
```

```dotenv
# /opt/clients/travel-agency/.env.production
APP_NAME="Travel Agency"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://travel-agency.meet-shah.online
COMPOSE_PROJECT_NAME=travel-agency
APP_PORT=127.0.0.1:8082
DB_DATABASE=travel_agency
DB_USERNAME=travel_agency_user
```

Generate a different application key for each client, then paste the printed result into that client’s `.env.production`:

```bash
docker compose --env-file .env.production -f docker-compose.production.yml run --rm app php artisan key:generate --show
```

Keep `ALLOW_DEMO_SEEDING=false` on real production sites. The committed bootstrap SQL imports only when a new MySQL volume is empty; never re-import it into a live client database.

Deploy each stack only from its own directory:

```bash
cd /opt/clients/uniworld-holidays && chmod +x deploy-ec2.sh && ./deploy-ec2.sh
cd /opt/clients/travel-agency && chmod +x deploy-ec2.sh && ./deploy-ec2.sh
```

The Compose files intentionally have no `container_name` entries. `COMPOSE_PROJECT_NAME` isolates containers, networks, and volumes, for example `uniworld-holidays_mysql_data` versus `travel-agency_mysql_data`.
Laravel is configured to trust the local reverse proxy’s `X-Forwarded-*` headers, so the application retains the HTTPS scheme and correct host behind Nginx/Cloudflare.

## 5. Host Nginx configuration

Create `/etc/nginx/sites-available/meet-shah-clients`. This is the host reverse proxy, not the Laravel Nginx configuration inside Docker.

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name uniworld-holidays.meet-shah.online travel-agency.meet-shah.online;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name uniworld-holidays.meet-shah.online;
    ssl_certificate     /etc/ssl/cloudflare/meet-shah.online.pem;
    ssl_certificate_key /etc/ssl/cloudflare/meet-shah.online.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    client_max_body_size 25m;
    location / {
        proxy_pass http://127.0.0.1:8081;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
        proxy_set_header X-Forwarded-Host $host;
    }
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name travel-agency.meet-shah.online;
    ssl_certificate     /etc/ssl/cloudflare/meet-shah.online.pem;
    ssl_certificate_key /etc/ssl/cloudflare/meet-shah.online.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    client_max_body_size 25m;
    location / {
        proxy_pass http://127.0.0.1:8082;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
        proxy_set_header X-Forwarded-Host $host;
    }
}
```

Enable it and remove the default host:

```bash
sudo ln -s /etc/nginx/sites-available/meet-shah-clients /etc/nginx/sites-enabled/meet-shah-clients
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx
```

Verify that app ports are loopback-only and both sites respond:

```bash
ss -ltn | grep -E ':(443|8081|8082)'
curl -I https://uniworld-holidays.meet-shah.online/health
curl -I https://travel-agency.meet-shah.online/health
```

## 6. Releases, backups, and safety

Release from the relevant client directory only:

```bash
cd /opt/clients/uniworld-holidays
git pull --ff-only
./deploy-ec2.sh
docker compose --env-file .env.production -f docker-compose.production.yml logs --tail=100 app
```

Back up before each release, keep backups outside Git, and copy them to encrypted object storage:

```bash
mkdir -p backups
docker compose --env-file .env.production -f docker-compose.production.yml exec -T mysql \
  sh -lc 'mysqldump -uroot -p"$MYSQL_ROOT_PASSWORD" --single-transaction --routines --triggers --events "$MYSQL_DATABASE"' \
  > backups/uniworld-holidays-$(date +%F-%H%M%S).sql
```

`docker compose down` preserves that client’s volumes. Never use `docker compose down -v` on a live client and never use `docker system prune --volumes` on this multi-client server.

## 7. Launch checklist

- [ ] Both Cloudflare A records are proxied and resolve to the Elastic IP.
- [ ] Cloudflare is Full (strict), never Flexible.
- [ ] Certificate and private key are only under `/etc/ssl/cloudflare/` with the documented permissions.
- [ ] Each client has unique `APP_KEY`, database/Redis passwords, database name, Compose project, and localhost port.
- [ ] `APP_DEBUG=false`, production mail, payment credentials, health endpoint, contact form, queues, and scheduler are verified for each domain.
- [ ] A current database backup and storage recovery plan exists per client.
