#!/bin/sh
set -e

echo "Waiting for database..."
until php bin/console doctrine:query:sql "SELECT 1" >/dev/null 2>&1; do
  sleep 2
done
echo "Database is ready."

mkdir -p public/uploads/artworks var/cache var/log var/sessions/prod
chmod -R 777 public/uploads/artworks var/cache var/log var/sessions 2>/dev/null || true

php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || true
php bin/console doctrine:query:sql "ALTER TABLE artwork ADD artwork_file VARCHAR(255) DEFAULT NULL" 2>/dev/null || true

exec symfony server:start --no-tls --port=8000 --allow-all-ip --dir=public
