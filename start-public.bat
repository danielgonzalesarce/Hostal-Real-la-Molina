@echo off
echo ========================================
echo   SERVIDOR PUBLICO - PUERTO 8000
echo ========================================
echo.
echo Iniciando servidor en puerto 8000 para sitio publico...
echo.
echo Acceso: http://localhost:8000
echo.
php artisan serve --port=8000 --host=127.0.0.1
pause

