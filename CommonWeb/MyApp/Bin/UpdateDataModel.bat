@ECHO off
call WaflCliBootstrap.bat
if errorlevel 0 (
    @ECHO Updating the data model...
    wapp UpdateDataModel
)