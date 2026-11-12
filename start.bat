@echo off
cd /d "%~dp0"

if not exist "public\bundle.js" (
    echo [1/2] Building frontend bundle...
    call npm run build
    if errorlevel 1 (
        echo Build failed.
        pause
        exit /b 1
    )
) else (
    echo [1/2] bundle.js already exists, skipping build.
)

echo [2/2] Starting server at http://localhost:8083 ...
start "" http://localhost:8083/
"C:\php-8.5.1-nts-Win32-vs17-x64\php.exe" -S localhost:8083 -t public
