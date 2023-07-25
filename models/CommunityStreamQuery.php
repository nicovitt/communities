<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace VittITServices\humhub\modules\communities\models;

use humhub\modules\stream\models\ContentContainerStreamQuery;

/**
 * ContentContainerStream is used to stream contentcontainers (space or users) content.
 *
 * Used to stream contents of a specific a content container.
 *
 * @since 0.11
 * @author Nico Vitt
 */
class CommunityStreamQuery extends ContentContainerStreamQuery
{
    protected function beforeApplyFilters()
    {
        parent::beforeApplyFilters();
    }

    //TODO: Make correct query for all ids
}
