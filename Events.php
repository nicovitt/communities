<?php

namespace  VittITServices\humhub\modules\communities;

use Yii;
use yii\base\WidgetEvent;
use yii\base\Event;
use yii\helpers\Url;
use humhub\modules\space\models\Space;
use humhub\modules\ui\menu\MenuLink;
use VittITServices\humhub\modules\communities\helpers\urlHelper;

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
                'url' => $event->sender->space->createUrl(urlHelper::toSpaceSettings()),
                'sortOrder' => 200,
                'isActive' => MenuLink::isActiveState('communities', 'manage')
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
        $event->sender->addItem([
            'label' => 'Communities',
            'icon' => '<i class="fa fa-sitemap"></i>',
            'url' => Url::to(['/communities/index']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'communities' && Yii::$app->controller->id == 'index'),
        ]);
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
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'communities' && Yii::$app->controller->id == 'admin'),
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
                'url' => $space->createUrl(urlHelper::toSpaceSettings()),
                'group' => 'manage',
                'icon' => '<i class="fa fa-sitemap"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'communities' && Yii::$app->controller->id == 'admin'),
                'sortOrder' => 99999,
            ]);
        }
    }
}
