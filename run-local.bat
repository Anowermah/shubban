@echo off
title Shubban Local Server
echo ==============================================
echo   Shubban (Laravel 12) Local Server
echo ==============================================
echo.
echo Starting server at http://127.0.0.1:8000 ...
echo Press Ctrl+C to stop the server.
echo.
php -S 127.0.0.1:8000 -t public
pause
