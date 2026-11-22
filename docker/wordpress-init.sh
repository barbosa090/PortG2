#!/bin/sh
set -eu

attempt=0
until wp db check --quiet; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 60 ]; then
        echo "Banco de dados indisponível após 120 segundos." >&2
        exit 1
    fi
    sleep 2
done

if ! wp core is-installed; then
    wp core install \
        --url="${WORDPRESS_URL}" \
        --title="${WP_SITE_TITLE}" \
        --admin_user="${WP_ADMIN_USER}" \
        --admin_password="${WP_ADMIN_PASSWORD}" \
        --admin_email="${WP_ADMIN_EMAIL}" \
        --locale=pt_BR
fi

wp option update home "${WORDPRESS_URL}"
wp option update siteurl "${WORDPRESS_URL}"
wp option update blogname "${WP_SITE_TITLE}"
wp option update timezone_string "${TZ}"
wp language core install pt_BR --activate

if wp user get "${WP_ADMIN_USER}" --field=ID >/dev/null 2>&1; then
    wp user update "${WP_ADMIN_USER}" \
        --role=administrator \
        --display_name="${WP_ADMIN_DISPLAY_NAME}"
else
    wp user create "${WP_ADMIN_USER}" "${WP_ADMIN_EMAIL}" \
        --role=administrator \
        --display_name="${WP_ADMIN_DISPLAY_NAME}" \
        --user_pass="${WP_ADMIN_PASSWORD}"
fi

for plugin in elementor ultimate-elementor wp-fastest-cache; do
    if ! wp plugin is-installed "${plugin}"; then
        wp plugin install "${plugin}"
    fi

    if ! wp plugin is-active "${plugin}"; then
        wp plugin activate "${plugin}"
    fi
done

echo "WordPress inicializado; plugins obrigatórios ativados."
