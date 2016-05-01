<?php
namespace Wafl\Cli;
$waflPath = getenv("WAFL_PATH");
if (!$waflPath)
{
    die("ERROR: The WAFL_PATH environment variable must be set in order to run CLI utilities\n");
}

$goodUsage = true;
if (!isset($argv[2]))
{
    $goodUsage = false;
}

if (!$goodUsage)
{
    die("USAGE: wapp <command|script> [<arg>, <arg>...]\n");
}
$scriptClass = $argv[2];
if (!class_exists("\\Wafl\\Cli\\$scriptClass"))
{
    $scriptFile = realpath(__DIR__.DIRECTORY_SEPARATOR.$scriptClass.".php");
    if (!$scriptFile || !file_exists($scriptFile))
    {
        $scriptFile = realpath($waflPath."Cli".DIRECTORY_SEPARATOR.$scriptClass.".php");
        if (!$scriptFile || !file_exists($scriptFile))
        {
            die("ERROR: Cannot find the specified application script: $scriptClass\n");
        } else {
            require_once($scriptFile);
        }
    } else {
        require_once($scriptFile);
    }
}

$appArgs = [];
foreach ($argv as $argIdx=>$argVal)
{
    if ($argIdx != 2)
    {
        $appArgs[] = $argVal;
    }
}

require_once($waflPath . "Cli/Cli.php");
Cli::RunAppScript("\\Wafl\\Cli\\$scriptClass", $appArgs, __DIR__);