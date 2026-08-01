@echo off
REM start-dev.bat
REM Menjalankan Laravel (php artisan serve) dan FastAPI (ml-api) di dua jendela terpisah.
REM Tutup masing-masing jendela CMD untuk menghentikan prosesnya.

echo === Menjalankan Laravel (port 8000) ===
start "Laravel" cmd /k "php artisan serve --port=8000"

echo === Menjalankan FastAPI (port 8001) ===
if not exist "ml-api\venv" (
    echo venv belum ada, membuat venv baru...
    start "FastAPI ml-api" cmd /k "cd ml-api && python -m venv venv && venv\Scripts\activate && pip install -r requirements.txt && uvicorn main:app --reload --port 8001"
) else (
    start "FastAPI ml-api" cmd /k "cd ml-api && venv\Scripts\activate && uvicorn main:app --reload --port 8001"
)

echo.
echo Laravel  : http://localhost:8000
echo FastAPI  : http://localhost:8001/docs
echo.
echo Dua jendela terminal baru telah dibuka. Tutup jendela tersebut untuk menghentikan servernya.
pause