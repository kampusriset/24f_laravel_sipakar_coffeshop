@echo off
REM start-dev.bat
REM Menjalankan Laravel (php artisan serve) dan FastAPI (ml-api) di dua jendela terpisah.
REM Tutup masing-masing jendela CMD untuk menghentikan prosesnya.

cd /d "%~dp0"

REM ── Simpan path project ke variabel agar mudah digunakan ──────────────────
set "PROJECT_DIR=%~dp0"
set "MLAPI_DIR=%~dp0ml-api"

echo === Menjalankan Laravel (port 8000) ===
REM Coba cari php di PATH dulu (jika sudah di-add), lalu fallback ke XAMPP
where php >nul 2>&1
if %ERRORLEVEL%==0 (
    start "Laravel Dev Server" cmd /k "cd /d "%PROJECT_DIR%" && php artisan serve --port=8000"
) else (
    start "Laravel Dev Server" cmd /k "cd /d "%PROJECT_DIR%" && "C:\xampp\php\php.exe" artisan serve --port=8000"
)

echo === Menjalankan FastAPI ML-API (port 8001) ===
if not exist "%MLAPI_DIR%\venv" (
    echo venv belum ada, membuat venv baru dan install dependencies...
    start "FastAPI ML-API" cmd /k "cd /d "%MLAPI_DIR%" && python -m venv venv && call venv\Scripts\activate.bat && pip install -r requirements.txt && uvicorn main:app --reload --port 8001"
) else (
    start "FastAPI ML-API" cmd /k "cd /d "%MLAPI_DIR%" && call venv\Scripts\activate.bat && uvicorn main:app --reload --port 8001"
)

echo.
echo [OK] Dua jendela terminal baru telah dibuka.
echo.
echo     Laravel  : http://localhost:8000
echo     FastAPI  : http://localhost:8001/docs
echo.
echo Tutup masing-masing jendela terminal untuk menghentikan server.
echo.
pause