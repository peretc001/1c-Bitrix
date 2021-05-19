<?
IncludeModuleLangFile(__FILE__);
Class krasovsky_email extends CModule
{
	const MODULE_ID = "krasovsky.email";
	const COMPONENTS_PATH = "krasovsky";

	var $MODULE_ID = self::MODULE_ID;
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	function krasovsky_email()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("KRASOVSKY_EMAIL_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("KRASOVSKY_EMAIL_MODULE_DESCRIPTION");

		$this->PARTNER_NAME = GetMessage("KRASOVSKY_EMAIL_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("KRASOVSKY_EMAIL_PARTNER_URI");
	}

	function InstallDB($arParams = array())
	{
		return true;
	}

	function UnInstallDB($arParams = array())
	{
		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
		if($_ENV["COMPUTERNAME"]!='BX')
		{
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/".self::MODULE_ID."/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true, true);
		}

		return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/".self::MODULE_ID."/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");

		return true;
	}

	function DoInstall()
	{
		$this->InstallFiles();
		$this->InstallDB();
		$this->InstallEvents();

		RegisterModule(self::MODULE_ID);
	}

	function DoUninstall()
	{
		$this->UnInstallFiles();
		$this->UnInstallDB();
		$this->UnInstallEvents();

		UnRegisterModule(self::MODULE_ID);
	}
}
?>
