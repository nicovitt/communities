<?php

namespace VittDigital\humhub\modules\communities\controllers;

use Yii;
use yii\helpers\Url;
use humhub\components\Controller;
use humhub\modules\content\components\ContentContainerController;
use VittDigital\humhub\modules\communities\components\CommunityDirectoryQuery;
use humhub\modules\space\components\SpaceDirectoryQuery;

class IndexController extends Controller
{
  /**
   * @inheritdoc
   */
  public $subLayout = '@communities/views/layouts/default';

  /**
   * Renders the index view for the module
   *
   * @return string
   */
  public function actionIndex()
  {
    $commDirectoryQuery = new CommunityDirectoryQuery();
    // return $this->render('index');
    return $this->render('index', ['communities' => $commDirectoryQuery]);
  }
}
