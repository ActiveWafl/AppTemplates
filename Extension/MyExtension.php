<?php

namespace {EXTENSIONS_NAMESPACE}\{EXTENSION_NAME};

use DblEj\Extensibility\ExtensionBase;
use DblEj\Extension\DependencyCollection;

class {EXTENSION_NAME} extends ExtensionBase
{
	private static $_tablePrefix;
	private static $_sitePages;
	
	public function Initialize(\DblEj\Application\IApplication $app)
	{
        $allsiteAreas = $app->Get_Sitemap()->GetSiteAreas();
        if (count($allsiteAreas)>0)
        {
            $siteArea = array_pop($allsiteAreas);
            $this->Set_SiteAreaId($siteArea->Get_AreaId());
        }
	}

	public static function Get_AvailableSettings()
	{
		return array("TablePrefix","SomeSetting1","SomeSetting2");
	}

	protected function ConfirmedConfigure($settingName, $settingValue)
	{
		switch ($settingName)
		{
			case "TablePrefix":
				self::$_tablePrefix = $settingValue;
				break;
		}
	}
	public function Get_RequiresInstallation()
	{
		 return !\Wafl\Core::$STORAGE_ENGINE->DoesLocationExist(self::$_tablePrefix."SomeRequiredTable");
	}

	public static function Get_DatabaseInstallScripts()
	{
		return array(realpath(__DIR__.DIRECTORY_SEPARATOR."Config/CreateTables.sql"));
	}

	public static function Get_DatabaseInstalledTables()
	{
		return array(
			self::$_tablePrefix."SomeRequiredTable",
			self::$_tablePrefix."SomeOtherTable"
		);
	}

	public static function Get_Dependencies()
	{
		$depends = new DependencyCollection();
		return $depends;
	}

	public static function Get_GlobalScripts()
	{
		return array("Global.js");
	}

	public static function Get_GlobalStylesheets()
	{
		return array("Global.css");
	}

	public static function Get_SitePages()
	{
        if (self::$_sitePages == null)
        {
            self::$_sitePages = array();
            self::$_sitePages["SomePage"] = new \DblEj\Extension\ExtensionSitePage("SomePage", "", "MyExtension/Presentation/Templates/SomePage.tpl");
        }
        return self::$_sitePages;
	}

	public static function Get_TablePrefix()
	{
		return self::$_tablePrefix;
	}

	public function Get_IsReady()
	{
		return true;
	}

	public function GetSettingDefault($settingName)
	{
        $returnVal = "";
		switch ($settingName)
        {
            case "TablePrefix":
                $returnVal = "";
                break;
            case "SomeSetting1":
                $returnVal = "SomeValue1";
                break;
            case "SomeSetting2":
                $returnVal = "SomeValue2";
                break;
        }
        return $returnVal;
	}

	public function GetRaisedEventTypes()
	{
		return array();
	}
}