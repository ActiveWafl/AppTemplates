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

if (!class_exists("\\Wafl\\Scripts\\ScriptUtil"))
{
    require_once($waflPath . "Scripts".DIRECTORY_SEPARATOR."ScriptUtil.php");
}
$scriptClass = $argv[2];
\Wafl\Scripts\ScriptUtil::ResolveAndIncludeScript($scriptClass);

$appArgs = [];
foreach ($argv as $argIdx=>$argVal)
{
    if ($argIdx != 2)
    {
        $appArgs[] = $argVal;
    }
}

\Wafl\Scripts\ScriptUtil::RunScriptOrCliApp($scriptClass, $appArgs);