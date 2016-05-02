@ECHO off
IF "%WAFL_PATH%" == "" GOTO PATHNOTSET

:PATHSET
set errorlevel=0
set RUNPATH=%WAFL_PATH%
GOTO FINISHED

:PATHNOTSET
set SCRIPT_DIR=%~dp0
for /f %%i in ('php %SCRIPT_DIR%\\..\\Cli\\GetWaflFolder.php') do set WAFL_PATH=%%i
set errorlevel=0
set RUNPATH=%WAFL_PATH%

:FINISHED