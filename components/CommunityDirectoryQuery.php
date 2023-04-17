<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace VittITServices\humhub\modules\communities\components;

use VittITServices\humhub\modules\communities\components\ActiveQueryCommunity;
use humhub\modules\space\models\Space;
use VittITServices\humhub\modules\communities\models\Community;
use Yii;
use yii\data\Pagination;

/**
 * CommunityDirectoryQuery is used to query Community records on the Communities page.
 *
 * @author Nico Vitt
 */
class CommunityDirectoryQuery extends ActiveQueryCommunity
{

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        parent::__construct(Community::class, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->visible();
    }
}
