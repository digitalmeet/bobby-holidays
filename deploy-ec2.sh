#!/bin/bash

# EC2 Deployment Script for Bobby Holidays
# Usage: copy .env.production.example to .env.production, configure it, then run ./deploy-ec2.sh

set -e

echo "=========================================="
echo "  Bobby Holidays - EC2 Deployment"
echo "=========================================="

# Configuration
APP_NAME="bobby-holidays"
DOCKER_COMPOSE_FILE="docker-compose.production.yml"
ENV_FILE=".env.production"
BOOTSTRAP_SQL="database/backups/bobby-holidays-bootstrap.sql"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if .env.production exists
if [ ! -f "$ENV_FILE" ]; then
    echo -e "${RED}Error: $ENV_FILE not found!${NC}"
    echo "Please copy .env.production.example to $ENV_FILE and configure it."
    exit 1
fi

if [ ! -f "$BOOTSTRAP_SQL" ]; then
    echo -e "${RED}Bootstrap database backup is missing: $BOOTSTRAP_SQL${NC}"
    exit 1
fi

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}Docker is not installed!${NC}"
    exit 1
fi

# Check if Docker Compose is available
if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    echo -e "${RED}Docker Compose is not installed!${NC}"
    exit 1
fi

# Use docker compose if available (v2), otherwise docker-compose
if docker compose version &> /dev/null; then
    DOCKER_COMPOSE="docker compose"
else
    DOCKER_COMPOSE="docker-compose"
fi

echo -e "${YELLOW}Step 1: Building Docker images...${NC}"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" build --pull

echo -e "${YELLOW}Step 2: Stopping existing containers...${NC}"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" down || true

echo -e "${YELLOW}Step 3: Starting containers...${NC}"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" up -d

echo -e "${YELLOW}Step 4: Running migrations...${NC}"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" exec -T app php artisan migrate --force

echo -e "${YELLOW}Step 5: Clearing and rebuilding cache...${NC}"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" exec -T app php artisan optimize

echo -e "${YELLOW}Step 6: Generating sitemap...${NC}"
if $DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" exec -T app php artisan list --raw | grep -qx 'sitemap:generate'; then
    $DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" exec -T app php artisan sitemap:generate
else
    echo -e "${YELLOW}Sitemap command is not available; skipping sitemap generation.${NC}"
fi

echo -e "${GREEN}=========================================="
echo "  Deployment Complete!"
echo "==========================================${NC}"

echo ""
echo "Services running:"
$DOCKER_COMPOSE --env-file "$ENV_FILE" -f "$DOCKER_COMPOSE_FILE" ps

echo ""
echo "Application URL: Check your EC2 public IP or domain"
echo ""
echo "Useful commands:"
echo "  View logs:     $DOCKER_COMPOSE --env-file $ENV_FILE -f $DOCKER_COMPOSE_FILE logs -f"
echo "  Stop:          $DOCKER_COMPOSE --env-file $ENV_FILE -f $DOCKER_COMPOSE_FILE down"
echo "  Restart:       $DOCKER_COMPOSE --env-file $ENV_FILE -f $DOCKER_COMPOSE_FILE restart"
echo "  Run migrations:$DOCKER_COMPOSE --env-file $ENV_FILE -f $DOCKER_COMPOSE_FILE exec app php artisan migrate"
echo ""
