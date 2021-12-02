<?php

namespace VittITServices\humhub\modules\communities;

use Yii;
use yii\helpers\Url;
use humhub\modules\space\models\Space;
use VittITServices\humhub\modules\communities\permissions\ManageCommunities;

class Module extends \humhub\components\Module
{
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
}
