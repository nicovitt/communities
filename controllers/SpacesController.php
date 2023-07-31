<?php

namespace VittDigital\humhub\modules\communities\controllers;

use Yii;
use yii\helpers\Url;
use humhub\components\Controller;
use humhub\modules\content\components\ContentContainerController;
use VittDigital\humhub\modules\communities\components\CommunityDirectoryQuery;
use humhub\modules\space\components\SpaceDirectoryQuery;

class SpacesController extends Controller
{
  /**
   * @inheritdoc
   */
  public $subLayout = '@communities/views/spaces/_layout';

  /**
   * @inheritdoc
   */
  public function init()
  {
    $this->setActionTitles([
      'index' => Yii::t('SpaceModule.base', 'Spaces'),
    ]);

    parent::init();
  }

  /**
   * Renders the spaces view for the module
   *
   * @return string
   */
  public function actionIndex()
  {
    $spaceDirectoryQuery = new SpaceDirectoryQuery();

    $urlParams = Yii::$app->request->getQueryParams();
    unset($urlParams['page']);
    array_unshift($urlParams, '/space/spaces/load-more');
    $this->getView()->registerJsConfig('cards', [
      'loadMoreUrl' => Url::to($urlParams),
    ]);

    return $this->render('index', [
      'spaces' => $spaceDirectoryQuery,
    ]);
  }
}
