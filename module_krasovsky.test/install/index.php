<?
IncludeModuleLangFile(__FILE__);
Class krasovsky_test extends CModule
{
	const MODULE_ID = "krasovsky.test";
	const COMPONENTS_PATH = "krasovsky";

	var $MODULE_ID = self::MODULE_ID;
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	function krasovsky_test()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("KRASOVSKY_TEST_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("KRASOVSKY_TEST_MODULE_DESCRIPTION");

		$this->PARTNER_NAME = GetMessage("KRASOVSKY_TEST_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("KRASOVSKY_TEST_PARTNER_URI");
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
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->registerEventHandler(
			'main',
			'OnAdminListDisplay',
			self::MODULE_ID,
			'CKrasovskyEvent',
			'eventHandler'
		);

		return true;
	}

	function UnInstallEvents()
	{
		$eventManager = \Bitrix\Main\EventManager::getInstance();
		$eventManager->unRegisterEventHandler(
			'main',
			'OnAdminListDisplay',
			self::MODULE_ID,
			'CKrasovskyEvent',
			'eventHandler'
		);

		return true;
	}

	function InstallFiles()
	{
		CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"]."/local/modules/".self::MODULE_ID."/install/components",
			$_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true
		);

		return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/components/".self::COMPONENTS_PATH."/");

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
