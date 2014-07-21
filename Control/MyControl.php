<?php

namespace {CONTROLS_NAMESPACE}\{CONTROL_NAME};

class MyControl extends \DblEj\Extensibility\ControlBase
{

	public function Initialize($width, $height, &$params)
	{
		
	}

	public static function Get_Dependencies()
	{
		return null;
	}

	public static function Get_MainTemplate()
	{
		return __DIR__.DIRECTORY_SEPARATOR."{CONTROL_NAME}.tpl";
	}

	public function GetRequiredParams()
	{
		return array("Id","SomeParam1","SomeParam2");
	}

	public function GetParamDefaultValue($paramName)
	{
		switch ($paramName)
		{
			case "Id":
				return "{CONTROL_NAME}_" . substr(md5(microtime(true)), 0, 7);
				break;
            case "SomeParam1":
				return "DefaultValue1";
				break;
			case "SomeParam2":
				return "DefaultValue2";
				break;
			default:
				return null;
				break;
		}
	}
}
?>