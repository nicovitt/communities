<?php

namespace VittDigital\humhub\modules\communities;

use Yii;
use yii\helpers\Url;
use humhub\modules\space\models\Space;
use VittDigital\humhub\modules\communities\filters\CommunityStreamFilter;
use VittDigital\humhub\modules\communities\permissions\ManageCommunities;

class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/communities/admin']);
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if ($contentContainer instanceof Space) {
            return [
                new ManageCommunities(),
            ];
        }

        return [];
    }

    /**
     * Dashboard stream query filter class used for members of the network
     * @var string
     * @since 1.8
     */
    public $memberFilterClass = CommunityStreamFilter::class;

    /**
     * @return static
     */
    public static function getModuleInstance()
    {
        /* @var $module static */
        $module = Yii::$app->getModule('communities');
        return $module;
    }
}
