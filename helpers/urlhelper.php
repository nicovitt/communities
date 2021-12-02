<?php

namespace VittITServices\humhub\modules\communities\helpers;


/**
 * Class Url
 */
class urlHelper extends \yii\helpers\Url
{
    const ROUTE_SPACE_SETTINGS = '/communities/space';
    const ROUTE_ADMIN = '/communities/admin';

    function domainname()
    {
        return urlHelper::base(true);
    }

    public static function toSpaceSettings()
    {
        return static::ROUTE_SPACE_SETTINGS;
    }

    // public static function toSpace()
    // {
    //     return static::to([static::ROUTE_SPACE]);
    // }

    // public static function toSpaceWithMessage(string $baseurl, string $message)
    // {
    //     return static::to([$baseurl . static::ROUTE_SPACE, 'message' => $message]);
    // }

    public static function toAdmin()
    {
        return static::to([static::ROUTE_ADMIN]);
    }
}