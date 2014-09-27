<?php

use Wafl\AppSupport\WebIndex,
    Wafl\Util\HttpRouter;

//first, let the router chain have a look at it.  
//Maybe someone can handle it right away with no need for all the init stuff.
$preAppRouter = null;
require_once(__DIR__ . "/../AppSupport.phar");
$application  = WebIndex::BootstrapApplication(__DIR__ . "/../Application.syrp", null, "\\Wafl\\Application\\MvcWebApplication");
$requestUri   = $_SERVER["REQUEST_URI"]; //@todo do all http servers use this header?  Tested in apache. And what about REDIRECT_URL, I was checking that as well elsewhere

$requestDomain = $_SERVER["SERVER_NAME"];
if (strtolower($requestDomain) != strtolower($application->Get_Settings()->Get_Web()->Get_DomainName()))
{
    throw new Wafl\Application\Settings\InvalidSettingException("DomainName","The domain name that you have set in Settings.".WAFL_ENVIRONMENT.".syrp (".$application->Get_Settings()->Get_Web()->Get_DomainName().") does not match the domain name in the current request URL ($requestDomain).  Please specify the correct domain or access the page through the specified URL.");
}

HttpRouter::RouteThruNonAppCalls($requestUri, $preAppRouter);

if ($preAppRouter === null)
{
    $localRoot      = $application->Get_Settings()->Get_Paths()->Get_Application()->Get_LocalRoot();
    $appFolder      = $application->Get_Settings()->Get_Application()->Get_RootNameSpace() . DIRECTORY_SEPARATOR;
    $localAppFolder = $localRoot . $appFolder;

    if (@file_exists($localAppFolder . $application->Get_Settings()->Get_Paths()->Get_Application()->Get_GlobalScript()))
    {
        include($localAppFolder . $application->Get_Settings()->Get_Paths()->Get_Application()->Get_GlobalScript());
    }
    WebIndex::RunApplication($application);
}
?>