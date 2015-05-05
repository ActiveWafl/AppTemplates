<?php
$requestUri   = $_SERVER["REQUEST_URI"]; //@todo do all http servers use this header?  Tested in apache. And what about REDIRECT_URL, I was checking that as well elsewhere

$waflEnv = getenv("WAFL_ENVIRONMENT");
if (!$waflEnv)
{
    die("You must set the WAFL_ENVIRONMENT environment variable");
}
$configFile = __DIR__.DIRECTORY_SEPARATOR."Config/Settings.$waflEnv.syrp";
if (!file_exists($configFile))
{
    die("Invalid config file Config/Settings.$waflEnv.syrp");
}
$configRaw = file_get_contents($configFile);
$matches = [];
$waflPathMatches = preg_match("/\\s*WaflFolder\\s*=\\s*\"([a-zA-Z0-9\\.\\\\\\/\-_\\s:]+)\"/", $configRaw, $matches);
$waflPath = null;
if ($waflPathMatches && $matches && count($matches) > 1)
{
    $waflPath = $matches[1];
}
if (!$waflPath)
{
    die("Can't get Wafl path from Config/Settings.$waflEnv.syrp");
}
require($waflPath."Autoloaders".DIRECTORY_SEPARATOR."Autoload.php");