@ECHO off
set SCRIPT_DIR=%~dp0
call "%SCRIPT_DIR%\\WaflCliBootstrap.bat" AppRoot="%SCRIPT_DIR%\\..\\..\\" %*

if not errorlevel 0 (
    @ECHO "There was an error ("
    @ECHO errorlevel
    @ECHO ") while running Wafl App Utilities."
    GOTO:EOF
)
php.exe "%SCRIPT_DIR%\\..\\Cli\\wapp.php" AppRoot="%SCRIPT_DIR%\\..\\..\\" %*