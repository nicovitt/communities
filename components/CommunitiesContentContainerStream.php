<?php

namespace VittITServices\humhub\modules\communities\components;

use humhub\modules\space\models\Space;
use humhub\modules\stream\actions\ContentContainerStream;

class CommunitiesContentContainerStream extends ContentContainerStream
{

    /**
     * @var ContentContainerActiveRecord[]
     */
    public $contentContainerIds;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    protected function initQuery($options = [])
    {
        $options['container'] = array();
        foreach ($this->contentContainerIds as $id) {
            $space = Space::findByGuid($id);
            if (!is_null($space)) {
                array_push($options['container'], $space);
            }
        }

        return parent::initQuery($options);
    }
}
