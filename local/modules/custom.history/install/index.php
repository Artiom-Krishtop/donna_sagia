<?

class custom_history extends CModule
{
  public $MODULE_ID = 'custom.history';
  public $MODULE_VERSION;
  public $MODULE_VERSION_DATE;
  public $MODULE_NAME;
  public $MODULE_DESCRIPTION;

  function __construct(){

    include(__DIR__.'/version.php');

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    $this->MODULE_NAME = GetMessage('CHANGE_ITEM_HISTORY_MODULE_NAME');
    $this->MODULE_DESCRIPTION = GetMessage('CHANGE_ITEM_HISTORY_MODULE_DESCRIPTION');
  }

  function DoInstall()
  {
    global $DB, $APPLICATION, $step;

    $this->InstallDB();

    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/step.php");
  }

  function DoUninstall()
  {
    global $DB, $APPLICATION, $step;

    $this->UnInstallDB();

    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/unstep.php");
  }

  public function InstallDB()
  {

    RegisterModule('custom.history');
    RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdateHandler');
    // RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    
  }

  public function UnInstallDB()
  {

    UnRegisterModule('custom.history');
    UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdateHandler');
    // UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
  }

}
