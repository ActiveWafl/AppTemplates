<?php
namespace Wafl\Cli;

require_once(__DIR__ . "/../../Application.php");
require_once(WAFL_PATH . "Cli/CliBase.php");
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
    require_once(WAFL_PATH . "Scripts".DIRECTORY_SEPARATOR."ScriptUtil.php");
}
$scriptClass = $argv[1];
switch ($scriptClass)
{
    case "CommandListXml":
        $xml = "<commands>";
        $xml .= "<command name=\"UpdateDataModel\">";
        $xml .= "<description>Create the data model files from a database connection</description>";
        $xml .= "<usage>wapp UpdateDataModel [SuperClasses] [TableNameMappings]</usage>";
        $xml .= "<help>SuperClasses can be used in place of the standard data model base class. TableNameMappings let you use custom names for the entity classes instead of the standard name.</help>";
        $xml .= "</command>";
        $xml .= "</commands>";
        print $xml;
        break;
    case "Help":
        die("USAGE: wapp <command|script> [<arg>, <arg>...]\n");
        break;
    default:
        if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$scriptClass.".php"))
        {
            require_once(__DIR__.DIRECTORY_SEPARATOR.$scriptClass.".php");
        }

        \Wafl\Scripts\ScriptUtil::ResolveAndRunScriptOrCliApp($scriptClass, array_slice($argv, 1));
        break;
}