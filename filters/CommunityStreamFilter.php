<?php

namespace VittITServices\humhub\modules\communities\filters;

use Yii;
use Yii\db\Query;
use humhub\modules\space\models\Space;
use humhub\modules\content\models\ContentContainer;
use humhub\modules\stream\models\filters\StreamQueryFilter;
use humhub\modules\user\models\User;

class CommunityStreamFilter extends StreamQueryFilter
{

    /**
     * @var string[]
     */
    public $contentContainerIds;

    public function apply()
    {
        if (is_array($this->contentContainerIds)) {
            $subquery = new Query();
            $paramsForWhere = array();
            foreach ($this->contentContainerIds as $key => $id) {
                // $space = Space::findByGuid($id);
                $contentcontainer = ContentContainer::find()->where(["guid" => $id])->one();
                $paramsForWhere[':contentcontainer_' . $key] = $contentcontainer->id;
                $subquery = $subquery->orWhere('content.contentcontainer_id = :contentcontainer_' . $key);
            }
            $this->query->andWhere($subquery->where, $paramsForWhere);
        }
    }
}
