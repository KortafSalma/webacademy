@echo off
setlocal
title WebAcademy - Serveur local
cd /d "%~dp0"
powershell.exe -NoLogo -NoProfile -ExecutionPolicy Bypass -File "%~dp0tools\start-local.ps1"
if errorlevel 1 (
    echo.
    echo Le lancement a echoue. Consulte le message ci-dessus.
    pause
)
endlocal
