<?php

namespace VittITServices\humhub\modules\communities\components;

use yii\db\ActiveQuery;
use humhub\modules\space\models\Space;
use humhub\modules\stream\models\StreamQuery;
use humhub\modules\content\models\Content;
use humhub\modules\stream\actions\ContentContainerStream;
use VittITServices\humhub\modules\communities\models\CommunityStreamQuery;

class CommunitiesContentContainerStream extends ContentContainerStream
{

    /**
     * @var string[]
     */
    public $contentContainerIds;

    /**
     * Custom StreamQuery
     */
    public $streamQuery = CommunityStreamQuery::class;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    protected function initQuery($options = [])
    {
        // $space = Space::find()->where(["guid" => $this->contentContainerIds[0]])->one();
        // $options['container'] = $space->getContentContainerRecord();
        // $this->contentContainer = $space;
        // $streamarray = new ActiveQuery(Content::class);
        // $parentquery = parent::initQuery($options);

        if (is_array($this->contentContainerIds)) {
            foreach ($this->contentContainerIds as $id) {
                // $space = Space::findByGuid($id);
                $space = Space::find()->where(["guid" => $id])->one();
                if (!is_null($space)) {
                    // $this->streamQuery->container = $space->getContentContainerRecord();
                    // $options['container'] = $space->getContentContainerRecord();
                    $this->contentContainer = $space;
                    $query = parent::initQuery($options);
                    // $parentquery->query()->joinWith($query->query());
                }
            }
        }

        // $streamarrayresult = $streamarray->all();
        // foreach ($streamarrayresult as $key => $value) {
        // }
        return $query;
    }
}
