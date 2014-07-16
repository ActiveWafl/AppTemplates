<?php

use Wafl\AppSupport\Application;

require_once(__DIR__ . "/../../AppSupport.phar");

$application = Application::BootstrapApplication(__DIR__ . "/../../Application.syrp", null, "\\Wafl\\Application\\Application");

$localRoot      = $application->Get_Settings()->Get_Paths()->Get_Application()->Get_LocalRoot();
$appFolder      = $application->Get_Settings()->Get_Application()->Get_RootNameSpace() . DIRECTORY_SEPARATOR;
$localAppFolder = $localRoot . $appFolder;

if (@file_exists($localAppFolder . $application->Get_Settings()->Get_Paths()->Get_Application()->Get_GlobalScript()))
{
    include($localAppFolder . $application->Get_Settings()->Get_Paths()->Get_Application()->Get_GlobalScript());
}
Application::Run($application)
?>
