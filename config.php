<?php

use VittITServices\humhub\modules\communities\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;
use humhub\components\ModuleManager;
use humhub\modules\space\modules\manage\widgets\DefaultMenu;

return [
	'id' => 'communities',
	'class' => 'VittITServices\humhub\modules\communities\Module',
	'namespace' => 'VittITServices\humhub\modules\communities',
	'events' => [
		[
			'class' => ModuleManager::class,
			'event' => ModuleManager::EVENT_AFTER_MODULE_ENABLE,
			'callback' => [Events::class, 'afterModuleEnabled']
		],
		[
            'class' => DefaultMenu::class, 
            'event' => DefaultMenu::EVENT_INIT, 
            'callback' => [Events::class, 'onSpaceSettingsInit']
        ],
		[
			'class' => TopMenu::class,
			'event' => TopMenu::EVENT_INIT,
			'callback' => [Events::class, 'onTopMenuInit'],
		],
		[
			'class' => AdminMenu::class,
			'event' => AdminMenu::EVENT_INIT,
			'callback' => [Events::class, 'onAdminMenuInit']
		],
	],
];
