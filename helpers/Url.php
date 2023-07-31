<?php

namespace VittDigital\humhub\modules\communities\helpers;


/**
 * Class Url
 */
class URL extends \yii\helpers\Url
{
    const ROUTE_SPACE_SETTINGS = '/communities/space';
    const ROUTE_MODIFIED_STREAM_ACTION = '/communities/space/communitystream';
    const ROUTE_ADMIN = '/communities/admin';

    function domainname()
    {
        return URL::base(true);
    }

    public static function toSpaceSettings()
    {
        return static::ROUTE_SPACE_SETTINGS;
    }

    public static function toModifiedStreamAction()
    {
        return static::ROUTE_MODIFIED_STREAM_ACTION;
    }

    // public static function toSpaceWithMessage(string $baseurl, string $message)
    // {
    //     return static::to([$baseurl . static::ROUTE_SPACE, 'message' => $message]);
    // }

    public static function toAdmin()
    {
        return static::to([static::ROUTE_ADMIN]);
    }
}
