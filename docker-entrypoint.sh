#!/bin/bash

set -e

echo "=========================================="
echo "SPMB SDN 21 Mataram - Container Starting"
echo "=========================================="

# Pastikan direktori storage Laravel tersedia
mkdir -p /var/www/html/storage/app/public

# Hapus symlink lama jika ada
if [ -L /var/www/html/public/storage ]; then
    rm /var/www/html/public/storage
fi

# Buat symlink Laravel storage
if [ ! -e /var/www/html/public/storage ]; then
    ln -s /var/www/html/storage/app/public /var/www/html/public/storage
fi

echo "Laravel storage link:"
ls -la /var/www/html/public/storage

# Jalankan Apache
exec apache2-foreground
