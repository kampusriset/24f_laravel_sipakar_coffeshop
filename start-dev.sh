#!/bin/bash
# start-dev.sh
# Menjalankan Laravel (php artisan serve) dan FastAPI (ml-api) secara bersamaan.
# Tekan CTRL+C sekali untuk menghentikan KEDUA proses.

# Pastikan kalau script ini dihentikan (CTRL+C), semua proses turunan ikut mati
trap "echo; echo 'Menghentikan semua proses...'; kill 0" EXIT

echo "=== Menjalankan Laravel (php artisan serve, port 8000) ==="
php artisan serve --port=8000 &

echo "=== Menjalankan FastAPI (ml-api, port 8001) ==="
cd ml-api

# Buat venv otomatis kalau belum ada
if [ ! -d "venv" ]; then
    echo "venv belum ada, membuat venv baru..."
    python3 -m venv venv
    source venv/bin/activate
    pip install -r requirements.txt
else
    source venv/bin/activate
fi

uvicorn main:app --reload --port 8001 &
cd ..

echo
echo "Laravel  : http://localhost:8000"
echo "FastAPI  : http://localhost:8001/docs"
echo "Tekan CTRL+C untuk menghentikan keduanya."

# Tunggu semua proses background selesai (atau sampai CTRL+C ditekan)
wait