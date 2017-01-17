@ECHO off
set SCRIPT_DIR=%~dp0
php.exe "%~dp0\..\Cli\wapp.php" %* AppRoot="%SCRIPT_DIR%..\..\\"