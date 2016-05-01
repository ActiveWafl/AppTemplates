@ECHO off
call WaflCliBootstrap.bat

if not errorlevel 0 (
    @ECHO "There was an error ("
    @ECHO errorlevel
    @ECHO ") while running Wafl App Utilities."
    GOTO:EOF
)
set SCRIPT_DIR=%~dp0
php.exe "%SCRIPT_DIR%\\..\\Cli\\wapp.php" AppRoot="%SCRIPT_DIR%\\..\\..\\" %*