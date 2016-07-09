<?php
$env = "";
$waflEnv = getenv("HTTP_WAFL_ENVIRONMENT") ? getenv("HTTP_WAFL_ENVIRONMENT") : null;
if (!$waflEnv)
{
    $waflEnv = getenv("WAFL_ENVIRONMENT") ? getenv("WAFL_ENVIRONMENT") : "dev";
}
if (!$waflEnv)
{
    $waflEnv = "dev";
}

$configFile = __DIR__.DIRECTORY_SEPARATOR."Config/Settings.$waflEnv.syrp";

if (!file_exists($configFile))
{
    throw new \Exception("Invalid config file Config/Settings.$waflEnv.syrp");
}
$configRaw = file_get_contents($configFile);
$matches = [];
$waflPathMatches = preg_match("/\\s*WaflFolder\\s*=\\s*\"([a-zA-Z0-9\\.\\\\\\/\-_\\s:]+)\"/", $configRaw, $matches);
$waflPath = null;
if ($waflPathMatches && $matches && count($matches) > 1)
{
    $waflPath = $matches[1];
}

$dblEjPathMatches = preg_match("/\\s*DblEjFolder\\s*=\\s*\"([a-zA-Z0-9\\.\\\\\\/\-_\\s:]+)\"/", $configRaw, $matches);
$dblEjPath = null;
if ($dblEjPathMatches && $matches && count($matches) > 1)
{
    $dblEjPath = $matches[1];
}

if (!$waflPath)
{
    throw new \Exception("Can't get Wafl path from Config/Settings.$waflEnv.syrp");
}
elseif (!file_exists($waflPath))
{
    throw new \Exception("Invalid Wafl path \e[3m$waflPath\e[0m.  Read from Config/Settings.$waflEnv.syrp. The environment is set to $waflEnv. This can be changed by setting the WAFL_ENVIRONMENT environment variable.");
}

if (!$dblEjPath)
{
    throw new \Exception("Can't get DblEj path from Config/Settings.$waflEnv.syrp");
}
elseif (!file_exists($dblEjPath))
{
    throw new \Exception("Invalid DblEj path in Config/Settings.$waflEnv.syrp. The environment is set to $waflEnv. This can be changed by setting the WAFL_ENVIRONMENT environment variable.");
}

$lastChar = substr($waflPath, strlen($waflPath) - 1);
if ($lastChar != "/" && $lastChar != "\\")
{
    $waflPath .= DIRECTORY_SEPARATOR;
}
define("WAFL_PATH", $waflPath);
define("DBLEJ_PATH", $dblEjPath);
define("WAFL_ENVIRONMENT", $waflEnv);

require($waflPath."Autoloaders".DIRECTORY_SEPARATOR."Autoload.php");
require($dblEjPath."Autoloader.php");