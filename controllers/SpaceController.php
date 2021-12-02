<?php

namespace VittITServices\humhub\modules\communities\controllers;

use Yii;
use humhub\components\Controller;
use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\space\models\Space;
use VittITServices\humhub\modules\communities\models\forms\SpaceSettingsForm;

class SpaceController extends ContentContainerController
{

    public function init()
    {
        parent::init();

        if($this->contentContainer instanceof Space) {
            $this->subLayout = "@humhub/modules/space/views/space/_layout";
        }
    }

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        // $space = $this->contentContainer;
        // $space->scenario = 'edit';

        // if ($space->load(Yii::$app->request->post()) && $space->validate() && $space->save()) {
        //     RichText::postProcess($space->about, $space);
        //     $this->view->saved();
        //     return $this->redirect($space->createUrl('index'));
        // }

        // $model = new Topic($this->contentContainer);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     $this->view->saved();
        // }

        // if ($model->hasErrors()) {
        //     $this->view->error($model->getFirstError('name'));
        // }
        $form = new SpaceSettingsForm($this->contentContainer->guid);

        if ($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            $this->view->saved();
            return $this->redirect(['settings']);
        }
        
        return $this->render('index', ['contentContainer' => $this->contentContainer, 'model' => $form,]);
    }
}
