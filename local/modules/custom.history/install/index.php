<?php

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Custom\History\Handlers\ChElementHandler;
use Custom\History\Handlers\ChPriceHandler;
use Custom\History\Handlers\ChPropertyHandler;
use Custom\History\ORM\HistoryTable;
use Custom\History\Tabs\TabHistory;

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
    $this->InstallFiles();
    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/step.php");
  }
  
  function DoUninstall()
  {
    global $APPLICATION;
    
    $this->UnInstallDB();
    $this->UnInstallEvents();
    $this->UnInstallFiles();

    ModuleManager::unRegisterModule($this->MODULE_ID);

    // $APPLICATION->IncludeAdminFile(GetMessage('CHANGE_ITEM_HISTORY_INSTALL_TITLE'),$_SERVER["DOCUMENT_ROOT"]."/local/modules/change.item.history/install/unstep.php");
  }
  
  public function InstallDB()
  {
    if(Loader::includeModule($this->MODULE_ID)){
      if (!($this->connection->isTableExists(HistoryTable::getTableName()))) {
        HistoryTable::getEntity()->createDbTable();
      }
    }
    
    return true;
  }
  
  public function UnInstallDB()
  {
    if (Loader::includeModule($this->MODULE_ID)) {
      $this->connection->dropTable(HistoryTable::getTableName());
    }

    return true;
  }
  
  public function InstallEvents()
  {
    $this->eventManager->registerEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'custom.history', ChElementHandler::class, 'onBeforeIBlockElementUpdateHandler');
    // $this->eventManager->registerEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'custom.history', ChElementHandler::class, 'onAfterIBlockElementUpdateHandler');

    // $this->eventManager->registerEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onBeforeUpdate','custom.history', ChPriceHandler::class, 'OnBeforePriceUpdateHandler');
    // $this->eventManager->registerEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onAfterUpdate','custom.history', ChPriceHandler::class, 'OnAfterPriceUpdateHandler');

    // $this->eventManager->registerEventHandler('iblock', 'OnIBlockElementSetPropertyValues','custom.history', ChPropertyHandler::class, 'onBeforePropertyUpdateHandler');
    // $this->eventManager->registerEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onAfterUpdate','custom.history', ChPriceHandler::class, 'OnAfterPriceUpdate');

    $this->eventManager->registerEventHandler('main', 'OnAdminIBlockElementEdit', 'custom.history', TabHistory::class, 'init');

    // dd($this->eventManager);

    return true;
  }

  public function UnInstallEvents()
  {    
    $this->eventManager->unRegisterEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'custom.history', ChElementHandler::class, 'onBeforeIBlockElementUpdateHandler');
    // $this->eventManager->unRegisterEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'custom.history', ChElementHandler::class, 'onAfterIBlockElementUpdateHandler');

    // $this->eventManager->unRegisterEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onBeforeUpdate','custom.history', ChPriceHandler::class, 'OnBeforePriceUpdateHandler');
    // $this->eventManager->unRegisterEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onAfterUpdate','custom.history', ChPriceHandler::class, 'OnAfterPriceUpdateHandler');

    // $this->eventManager->unRegisterEventHandler('iblock', 'Bitrix\Iblock\ElementPropertyTable::onBeforeUpdate','custom.history', ChPropertyHandler::class, 'onBeforePropertyUpdateHandler');
    // $this->eventManager->unRegisterEventHandler('catalog', 'Bitrix\Catalog\Model\Price::onAfterUpdate','custom.history', ChPriceHandler::class, 'OnAfterPriceUpdate');

    $this->eventManager->unRegisterEventHandler('main', 'OnAdminIBlockElementEdit', 'custom.history', TabHistory::class, 'init');

  
    return true;
  }

  public function InstallFiles()
  {
    CopyDirFiles($_SERVER["DOCUMENT_ROOT"]. '/local/modules/custom.history/install/components', $_SERVER['DOCUMENT_ROOT'] . '/local/components', true, true);
  } 

  public function UnInstallFiles()
  {
    DeleteDirFilesEX($_SERVER['DOCUMENT_ROOT'] . '/local/components/custom/custom.history'); 
  }
}
