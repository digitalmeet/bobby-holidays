# Deploying UniWorld Holidays on Amazon EC2

This repository includes a production Docker stack: Laravel/Nginx/PHP-FPM, MySQL 8.4, Redis, queue workers, the scheduler, persistent Docker volumes, health checks, and a deployment script. It does not commit production secrets.

## 1. Prepare the EC2 instance

Use an Ubuntu 24.04 LTS instance with at least 2 GB memory (for example, `t3.small` for a small deployment). Attach an Elastic IP or point your domain at the instance. In the security group, allow:

- TCP 22 from your administrator IP only.
- TCP 80 from the internet.
- TCP 443 from the internet after TLS is configured.

Install Docker Engine and the Compose plugin using Docker's current official Ubuntu instructions. Confirm the installation:

```bash
docker --version
docker compose version
```

For an Ubuntu server where Docker is not installed, the distribution packages provide a straightforward starting point:

```bash
sudo apt update
sudo apt install -y git docker.io docker-compose-v2
sudo systemctl enable --now docker
sudo usermod -aG docker "$USER"
exit
```

Reconnect by SSH after the final command so the Docker group membership applies. Confirm with `docker ps` without `sudo`.

## 2. Fetch and configure the application

```bash
cd /opt
sudo git clone <your-repository-url> bobby-holidays
sudo chown -R "$USER":"$USER" /opt/bobby-holidays
cd /opt/bobby-holidays
cp .env.production.example .env.production
```

Edit `.env.production` before deploying. At a minimum, set a unique `APP_KEY`, the final `APP_URL`, strong and unique database/Redis passwords, mail credentials, payment credentials if payments are enabled, and S3 credentials only when S3 storage is used. Keep `APP_ENV=production`, `APP_DEBUG=false`, and `ALLOW_DEMO_SEEDING=false`.

Generate an application key locally with a trusted PHP installation, or after the first image build run:

```bash
docker compose --env-file .env.production -f docker-compose.production.yml run --rm app php artisan key:generate --show
```

Copy the printed `base64:...` value into `APP_KEY` in `.env.production`. Do not use `key:generate` without `--show` on a production container because the environment file is intentionally mounted as read-only configuration rather than changed from inside the container.

## 3. Database bootstrap and persistence

`database/backups/bobby-holidays-bootstrap.sql` is a committed backup of the configured local database. Both Compose files mount it into MySQL's `/docker-entrypoint-initdb.d/` directory. MySQL imports it automatically **only when `mysql_data` is empty**, before Laravel starts. This gives a new EC2 server the same initial database structure and demo/configuration data.

Do not remove or recreate `mysql_data` on a live server: it contains production records. Normal deployments preserve it. To confirm the first import completed:

```bash
docker compose --env-file .env.production -f docker-compose.production.yml exec mysql \
  sh -lc 'mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "SHOW DATABASES;"'
```

To restore the committed bootstrap backup into a deliberately empty or disposable database, use the mounted file from inside the MySQL container:

```bash
docker compose --env-file .env.production -f docker-compose.production.yml exec -T mysql \
  sh -lc 'mysql -uroot -p"$MYSQL_ROOT_PASSWORD" < /docker-entrypoint-initdb.d/001-bobby-holidays-bootstrap.sql'
```

For real production data, create a fresh backup before every release:

```bash
mkdir -p backups
docker compose --env-file .env.production -f docker-compose.production.yml exec -T mysql \
  sh -lc 'mysqldump -uroot -p"$MYSQL_ROOT_PASSWORD" --single-transaction --routines --triggers --events bobby_holidays' \
  > backups/bobby-holidays-$(date +%F-%H%M%S).sql
```

## 4. First deployment

```bash
chmod +x deploy-ec2.sh
./deploy-ec2.sh
```

The script builds the application image, starts MySQL and Redis, runs production migrations, rebuilds Laravel caches, and generates the sitemap. Data and uploaded files persist in named Docker volumes (`mysql_data`, `redis_data`, and `storage_data`) across normal container rebuilds.

Verify the release:

```bash
docker compose --env-file .env.production -f docker-compose.production.yml ps
curl -I http://127.0.0.1/health
docker compose --env-file .env.production -f docker-compose.production.yml logs --tail=100 app
```

The deployment script validates the environment file and committed bootstrap backup, rebuilds images, starts containers, runs database migrations, optimizes Laravel, and prints service status. It is safe for routine updates because it does not remove Docker volumes.

## 5. Enable HTTPS

The bundled application container serves HTTP on port 80. Put it behind an HTTPS-capable load balancer, Caddy, or Nginx reverse proxy and terminate TLS there. Set `APP_URL` to the final `https://` domain before deployment, then configure your proxy to forward requests to `127.0.0.1:80`. Do not expose MySQL (3306) or Redis (6379) publicly.

## 6. Operations and updates

For a normal update, pull the approved revision and run the same deployment script:

```bash
git pull --ff-only
./deploy-ec2.sh
```

Useful operations:

```bash
# Container status
docker compose --env-file .env.production -f docker-compose.production.yml ps

# Follow application and queue-worker logs
docker compose --env-file .env.production -f docker-compose.production.yml logs -f app

# Run a one-off Laravel command
docker compose --env-file .env.production -f docker-compose.production.yml exec app php artisan about

# Run migrations manually, if required
docker compose --env-file .env.production -f docker-compose.production.yml exec -T app php artisan migrate --force

# Stop containers without deleting database/uploads
docker compose --env-file .env.production -f docker-compose.production.yml down
```

Never run `docker compose down -v` on a live server unless you intentionally want to erase its MySQL, Redis, and uploaded-file volumes. Copy the `storage_data` volume or move uploads to S3 for disaster recovery. Review logs after each deploy and monitor `/health` from your infrastructure provider.
