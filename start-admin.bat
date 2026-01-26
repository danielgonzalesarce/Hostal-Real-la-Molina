@echo off
echo ========================================
echo   SERVIDOR ADMIN - PUERTO 8001
echo ========================================
echo.
echo Iniciando servidor en puerto 8001 para panel administrativo...
echo.
echo Acceso: http://localhost:8001/admin/login
echo.
php artisan serve --port=8001 --host=127.0.0.1
pause

