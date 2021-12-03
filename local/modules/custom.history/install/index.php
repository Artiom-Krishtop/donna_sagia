<?php

use Bitrix\B24Connector\Connection;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Custom\History\ORM\CreateItemHistoryTable;

class custom_history extends CModule
{

  
  public $MODULE_ID = 'custom.history';
  public $MODULE_VERSION;
  public $MODULE_VERSION_DATE;
  public $MODULE_NAME;
  public $MODULE_DESCRIPTION;

  protected $eventManager;
  protected $connection;

  function __construct(){

    include(__DIR__.'/version.php');

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    $this->MODULE_NAME = GetMessage('CHANGE_ITEM_HISTORY_MODULE_NAME');
    $this->MODULE_DESCRIPTION = GetMessage('CHANGE_ITEM_HISTORY_MODULE_DESCRIPTION');

    $this->eventManager = EventManager::getInstance();
    $this->connection = Application::getConnection();
  }

  function DoInstall()
  {
    global $APPLICATION;
    
    ModuleManager::registerModule($this->MODULE_ID);

    $this->InstallDB();
    $this->InstallEvents();
     
    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/step.php");
  }
  
  function DoUninstall()
  {
    global $APPLICATION;
    
    $this->UnInstallDB();
    $this->UnInstallEvents();

    ModuleManager::unRegisterModule($this->MODULE_ID);

    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/unstep.php");
  }
  
  public function InstallDB()
  {
    if(Loader::includeModule($this->MODULE_ID)){
      if (!($this->connection->isTableExists(CreateItemHistoryTable::getTableName()))) {
        CreateItemHistoryTable::getEntity()->createDbTable();
      }
    }
    
    return true;
  }
  
  public function UnInstallDB()
  {
    if (Loader::includeModule($this->MODULE_ID)) {
      $this->connection->dropTable(CreateItemHistoryTable::getTableName());
    }

    return true;
  }

  public function InstallEvents()
  {
    $this->eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'custom.history', '\\Custom\\History\\Handlers\\IBlockEventHandler', 'onBeforeIBlockElementUpdateHundler');
    $this->eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'custom.history', '\\Custom\\History\\Handlers\\IBlockEventHandler', 'onAfterIBlockElementUpdateHandler');
    
    // RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // RegisterModuleDependences('catalog', 'OnBeforePriceUpdate', 'custom.history', '\\Custom\\History\\EventHandler\\EventHandler', 'OnBeforePriceUpdateHandler');
    // RegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');

    return true;
  }

  public function UnInstallEvents()
  {    
    $this->eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'custom.history', '\\Custom\\History\\Handlers\\IBlockEventHandler', 'onBeforeIBlockElementUpdateHundler');
    $this->eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'custom.history', '\\Custom\\History\\Handlers\\IBlockEventHandler', 'onAfterIBlockElementUpdateHandler');
    // UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');
    // UnRegisterModuleDependences('catalog', 'OnBeforePriceUpdate', 'custom.history', '\\Custom\\History\\EventHandler\\EventHandler', 'onBeforePriceUpdateHandler');
    // UnRegisterModuleDependences('iblock', 'OnIBlockElementUpdate', 'custom_history', '\\Custom\\History\\EventHandler\\EventHadler', 'onIBlockElementUpdate');

    return true;
  }


}
