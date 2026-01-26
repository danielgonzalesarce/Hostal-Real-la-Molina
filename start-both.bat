@echo off
echo ========================================
echo   INICIANDO AMBOS SERVIDORES
echo ========================================
echo.
echo Iniciando servidor PUBLICO en puerto 8000...
start "Servidor Publico - Puerto 8000" cmd /k "php artisan serve --port=8000 --host=127.0.0.1"
timeout /t 2 /nobreak >nul
echo.
echo Iniciando servidor ADMIN en puerto 8001...
start "Servidor Admin - Puerto 8001" cmd /k "php artisan serve --port=8001 --host=127.0.0.1"
timeout /t 2 /nobreak >nul
echo.
echo ========================================
echo   SERVIDORES INICIADOS
echo ========================================
echo.
echo Sitio Publico: http://localhost:8000
echo Panel Admin:   http://localhost:8001/admin/login
echo.
echo Presiona cualquier tecla para cerrar esta ventana...
pause >nul

