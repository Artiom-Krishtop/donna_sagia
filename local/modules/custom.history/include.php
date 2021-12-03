<?
CModule::AddAutoloadClasses(
	"custom.history",
	array(
        // EventHandlers
        'Custom\\History\\Handlers\\IBlockEventHandler' => 'lib/handlers/iblockeventhandler.php',

		// ORM
		  'Custom\\History\\ORM\\CreateItemHistoryTable' =>'lib/orm/createitemhistory.php',
	)
);
?>