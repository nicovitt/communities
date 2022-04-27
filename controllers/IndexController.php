<?php

namespace VittITServices\humhub\modules\communities\controllers;

use humhub\components\Controller;
use VittITServices\humhub\modules\communities\components\CommunityDirectoryQuery;
use VittITServices\humhub\modules\communities\models\Community;
use VittITServices\humhub\modules\communities\models\forms\SpaceSettingsForm;

class IndexController extends Controller
{

    public $subLayout = "@communities/views/layouts/default";

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        $commDirectoryQuery = new CommunityDirectoryQuery();
    
        // return $this->render('index');

        return $this->render('index', ['communities' => $commDirectoryQuery,]);
    }

}

