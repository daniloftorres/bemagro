#!/bin/bash
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Permissões de /var/www/html/storage:"
ls -la /var/www/html/storage
echo "Permissões de /var/www/html/bootstrap/cache:"
ls -la /var/www/html/bootstrap/cache


#chown -R www-data:www-data /var/www/html
#chmod -R 755 /var/www/html

# Iniciar PHP-FPM ou outro serviço necessário
exec "$@"
