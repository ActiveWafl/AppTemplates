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
switch ($scriptClass)
{
    case "CommandListXml":
        $xml = "<commands>";
        $xml .= "<command name=\"UpdateDataModel\">";
        $xml .= "<usage>wapp UpdateDataModel [SuperClasses] [TableNameMappings]</usage>";
        $xml .= "<description>Create the data model files from a database connection</description>";
        $xml .= "<help>SuperClasses can be used in place of the standard data model base class. TableNameMappings let you use custom names for the entity classes instead of the standard name.</help>";
        $xml .= "</command>";
        $xml .= "</commands>";
        print $xml;
        break;
    case "Help":
        die("USAGE: wapp <command|script> [<arg>, <arg>...]\n");
        break;
    default:
        \Wafl\Scripts\ScriptUtil::ResolveAndRunScriptOrCliApp($scriptClass, $argv);
        break;
}