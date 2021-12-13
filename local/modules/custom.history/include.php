<?
CModule::AddAutoloadClasses(
	"custom.history",
	array(
    // EventHandlers
    'Custom\\History\\Handlers\\ChElementHandler' => 'lib/handlers/chelementhandler.php',
    // 'Custom\\History\\Handlers\\ChPropertyHandler' => 'lib/handlers/chpropertyhandler.php',
    // 'Custom\\History\\Handlers\\ChPriceHandler' => 'lib/handlers/chpricehandler.php',
    // 'Custom\\History\\Handlers\\ChQuantityHandler' => 'lib/handlers/chpquantityhandler.php',
    
    // TABS
      'Custom\\History\\Tabs\\TabHistory' => 'lib/tabs/tabhistory.php',

		// ORM
		  'Custom\\History\\ORM\\HistoryTable' =>'lib/orm/history.php',
	)
);
?>