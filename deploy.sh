#!/bin/bash
# -----------------------------------------------
# MJ Portfolio — Production Deployment Script
# Run from the project root on your server.
# -----------------------------------------------

set -e

echo "🚀 Starting production deployment..."

# 1. Pull latest changes (uncomment if using git)
# git pull origin main

# 2. Install dependencies
echo "  → Installing Composer dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

echo "  → Installing npm dependencies and building assets..."
npm ci --no-audit --no-fund
npm run build

# 3. Environment check
if [ ! -f .env ]; then
    echo "  → No .env found — copying from .env.production.example"
    cp .env.production.example .env
    echo "  ⚠️  Edit .env now with production values (APP_KEY, DB_*, MAIL_*), then re-run."
    exit 1
fi

# 4. Generate app key if missing
if ! grep -q "APP_KEY=base64:" .env; then
    echo "  → Generating APP_KEY..."
    php artisan key:generate
fi

# 5. Create storage symlink
echo "  → Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

# 6. Run database migrations
echo "  → Running migrations..."
php artisan migrate --force --no-interaction

# 7. Seed admin user (idempotent — skips if exists)
if grep -q "ADMIN_PASSWORD=" .env; then
    echo "  → Seeding admin user..."
    php artisan db:seed --force --no-interaction
fi

# 8. Clear and rebuild caches
echo "  → Clearing and rebuilding caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Optimize
echo "  → Optimizing..."
php artisan optimize

# 10. Restart queue worker (adjust for your process manager)
# echo "  → Restarting queue worker..."
# php artisan queue:restart

echo "✅ Production deployment complete!"
echo ""
echo "  Site: ${APP_URL:-https://your-domain.com}"
echo "  Admin: ${APP_URL:-https://your-domain.com}/admin"
