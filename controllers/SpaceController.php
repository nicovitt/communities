<?php

namespace VittITServices\humhub\modules\communities\controllers;

use Yii;
use yii\helpers\Url;
use humhub\components\Controller;
use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\space\models\Space;
use VittITServices\humhub\modules\communities\models\forms\SpaceSettingsForm;
use VittITServices\humhub\modules\communities\components\CommunitiesContentContainerStream;
use VittITServices\humhub\modules\communities\components\CommunityDirectoryQuery;

class SpaceController extends ContentContainerController
{
  public function init()
  {
    parent::init();

    if ($this->contentContainer instanceof Space) {
      $this->subLayout = "@humhub/modules/space/views/space/_layout";
    }
  }

  public function actions()
  {
    return [
      'communitystream' => [
        'class' => CommunitiesContentContainerStream::class,
        'contentContainerIds' => isset($_GET["child_ids"]) ? $_GET["child_ids"] : array(),
      ],
    ];
  }

  /**
   * Renders the index view for the module
   *
   * @return string
   */
  public function actionIndex()
  {
    $commDirectoryQuery = new CommunityDirectoryQuery();
    $form = new SpaceSettingsForm($this->contentContainer->guid);

    if (
      $form->load(Yii::$app->request->post()) &&
      $form->validate() &&
      $form->save()
    ) {
      $this->view->saved();
      return $this->redirect(['settings']);
    }

    return $this->render('index', [
      'contentContainer' => $this->contentContainer,
      'model' => $form,
      'communities' => $commDirectoryQuery,
    ]);
  }
}
