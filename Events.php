<?php

namespace VittITServices\humhub\modules\communities;

use Yii;
use yii\base\Event;
use yii\helpers\Url;
use humhub\modules\space\models\Space;
use humhub\modules\ui\menu\MenuLink;
use humhub\modules\stream\widgets\StreamViewer;
use VittITServices\humhub\modules\communities\models\Community;
use VittITServices\humhub\modules\communities\helpers\Url as urlManager;
use humhub\libs\WidgetCreateEvent;
use VittITServices\humhub\modules\communities\widgets\CommunitiesChooser;
use VittITServices\humhub\modules\communities\widgets\CommunitiesDirectoryCard;
use yii\base\ActionEvent;

class Events
{
  /**
   * Defines what to do when the module is enabled.
   *
   * @param $event
   */
  public static function afterModuleEnabled($event)
  {
  }

  /**
   * Defines what to do when the space settings page is called.
   *
   * @param $event
   */
  public static function onSpaceSettingsInit(Event $event)
  {
    // $space = $event->sender->space;

    // if ($space->isAdmin()) {
    //     $event->sender->addItem([
    //         'label' => Yii::t('TopicModule.base', 'Topics'),
    //         'url' => $space->createUrl('/topic/manage'),
    //         'isActive' => MenuLink::isActiveState('topic', 'manage'),
    //         'sortOrder' => 250
    //     ]);
    // }
    if ($event->sender->space->isAdmin()) {
      $event->sender->addItem([
        'label' => Yii::t('CommunitiesModule.base', 'Communities'),
        'url' => $event->sender->space->createUrl(
          urlManager::toSpaceSettings()
        ),
        'sortOrder' => 200,
        'isActive' => MenuLink::isActiveState('communities', 'space', 'index'),
      ]);
    }
  }

  /**
   * Defines what to do when the top menu is initialized.
   *
   * @param $event
   */
  public static function onTopMenuInit($event)
  {
    // $event->sender->addItem([
    //   'label' => 'Communities',
    //   'icon' => '<i class="fa fa-sitemap"></i>',
    //   'url' => Url::to(['/communities/index']),
    //   'sortOrder' => 99999,
    //   'isActive' =>
    //     Yii::$app->controller->module &&
    //     Yii::$app->controller->module->id == 'communities' &&
    //     Yii::$app->controller->id == 'index',
    // ]);
  }

  /**
   * Defines what to do if admin menu is initialized.
   *
   * @param $event
   */
  public static function onAdminMenuInit($event)
  {
    $event->sender->addItem([
      'label' => 'Communities',
      'url' => Url::to(['/communities/admin']),
      'group' => 'manage',
      'icon' => '<i class="fa fa-sitemap"></i>',
      'isActive' =>
      Yii::$app->controller->module &&
        Yii::$app->controller->module->id == 'communities' &&
        Yii::$app->controller->id == 'admin',
      'sortOrder' => 99999,
    ]);
  }

  /**
   * Defines what to do if the communities-tabs in space settings is selected.
   *
   * @param $event
   */
  public static function onSpaceCommunitySettingsTab(Event $event)
  {
    if ($event->sender->space !== null) {
      /** @var Menu $sender */
      // $sender = $event->sender;
      // if (!($sender instanceof Menu)) {
      //     throw new \LogicException();
      // }

      /** @var Space $space */
      $space = $sender->space;
      if (!($space instanceof Space)) {
        throw new \LogicException();
      }
      // $event->sender->addItem([
      //     'label' => 'Paper Input',
      //     'group' => 'modules',
      //     'icon' => '<i class="fa fa-book"></i>',
      //     'url' => $space->createUrl(urlManager::toSpaceFromMenu()),
      //     'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'daveandpeterspaperscheduleinput'),
      // ]);

      $event->sender->addItem([
        'label' => 'Communities',
        'url' => $space->createUrl(urlManager::toSpaceSettings()),
        'group' => 'manage',
        'icon' => '<i class="fa fa-sitemap"></i>',
        'isActive' =>
        Yii::$app->controller->module &&
          Yii::$app->controller->module->id == 'communities' &&
          Yii::$app->controller->id == 'admin',
        'sortOrder' => 99999,
      ]);
    }
  }

  /**
   * Defines what to do when a task is displayed on the wall.
   *
   * @param $event of type yii\base\WidgetEvent
   */
  public static function onCreateWallEntry($event)
  {
    if (
      get_class($event->sender) != StreamViewer::class ||
      is_null($event->sender->contentContainer) ||
      get_class($event->sender->contentContainer) != Space::class
    ) {
      return $event;
    }

    // Check if contentcontainerid has children in communities db-table
    $contentcontainerids = [];
    array_push($contentcontainerids, $event->sender->contentContainer->guid);
    $communities = Community::find()->where(['parent_id' => $event->sender->contentContainer->guid])->all();
    if (count($communities) > 0) {
      // If contentcontainer has children a custom streamviewer with events from children should be returned
      foreach ($communities as $community) {
        array_push($contentcontainerids, $community->child_id);
      }
      $event->sender->streamActionParams["child_ids"] = $contentcontainerids;
      $event->sender->streamAction = urlManager::toModifiedStreamAction();
    }

    return $event;
  }

  public static function onSpaceChooserCreate(WidgetCreateEvent $event)
  {
    $event->config['class'] = CommunitiesChooser::class;
  }

  public static function onSpacesDirectoryCardCreate(WidgetCreateEvent $event)
  {
    $event->config['class'] = CommunitiesDirectoryCard::class;
  }

  public static function onSpacesDirectoryActionBefore(ActionEvent $event)
  {
    if ($event->action->id === "index") {
      // Do not continue running the action.
      $event->isValid = false;
      // Manipulate action result
      $event->result = Yii::$app->response->redirect(['/communities/spaces']);
    }
  }
}
