call WaflCliBootstrap.bat
if errorlevel 0 (
    @ECHO Updating the data model...
    php.exe ../../../shared/Wafl/Cli/UpdateDataModel.php AppRoot=%~dp0../../
)