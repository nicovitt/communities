<?php

namespace VittDigital\humhub\modules\communities\actions;

use Yii;
use humhub\modules\space\models\Space;
use humhub\modules\stream\actions\ContentContainerStream;
use humhub\modules\content\widgets\stream\WallStreamEntryOptions;
use VittDigital\humhub\modules\communities\models\CommunityStreamQuery;
use VittDigital\humhub\modules\communities\filters\CommunityStreamFilter;

class CommunityStreamAction extends ContentContainerStream
{

    /**
     * @var string[]
     */
    public $contentContainerIds;

    /**
     * @inheritDoc
     */
    public $streamQueryClass = CommunityStreamQuery::class;

    /**
     * @inheritDoc
     */
    public $streamQuery = CommunityStreamQuery::class;

    protected function initQuery($options = [])
    {
        $options["contentContainerIds"] = $this->contentContainerIds;
        $query = parent::initQuery($options);
        return $query;
    }
}
