<?php

use VittDigital\humhub\modules\communities\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;
use humhub\components\Widget;
use humhub\components\ModuleManager;
use humhub\modules\space\modules\manage\widgets\DefaultMenu;
use humhub\modules\stream\widgets\StreamViewer;
use humhub\modules\space\widgets\Chooser;
use humhub\modules\space\widgets\SpaceDirectoryCard;
use humhub\modules\space\controllers\SpacesController;

return [
  'id' => 'communities',
  'class' => 'VittDigital\humhub\modules\communities\Module',
  'namespace' => 'VittDigital\humhub\modules\communities',
  'events' => [
    [
      'class' => ModuleManager::class,
      'event' => ModuleManager::EVENT_AFTER_MODULE_ENABLE,
      'callback' => [Events::class, 'afterModuleEnabled'],
    ],
    [
      'class' => DefaultMenu::class,
      'event' => DefaultMenu::EVENT_INIT,
      'callback' => [Events::class, 'onSpaceSettingsInit'],
    ],
    [
      'class' => TopMenu::class,
      'event' => TopMenu::EVENT_INIT,
      'callback' => [Events::class, 'onTopMenuInit'],
    ],
    [
      'class' => AdminMenu::class,
      'event' => AdminMenu::EVENT_INIT,
      'callback' => [Events::class, 'onAdminMenuInit'],
    ],
    [
      'class' => StreamViewer::class,
      'event' => Widget::EVENT_BEFORE_RUN,
      'callback' => [Events::class, 'onCreateWallEntry'],
    ],
    // Prevent SpaceChooserWidget from rendering and use modified widget
    [
      'class' => Chooser::class,
      'event' => Chooser::EVENT_CREATE,
      'callback' => [Events::class, 'onSpaceChooserCreate'],
    ],
    // Prevent SpacesDirectory from rendering and use modified widget
    [
      'class' => SpaceDirectoryCard::class,
      'event' => SpaceDirectoryCard::EVENT_CREATE,
      'callback' => [Events::class, 'onSpacesDirectoryCardCreate'],
    ],
    // Redirect call to spaces to communities
    [
      'class' => SpacesController::class,
      'event' => SpacesController::EVENT_BEFORE_ACTION,
      'callback' => [Events::class, 'onSpacesDirectoryActionBefore'],
    ],
  ],
];
