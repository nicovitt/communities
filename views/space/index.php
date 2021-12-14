<?php
/* @var $model VittITServices\humhub\modules\communities\models\forms\SpaceSettingsForm */

use humhub\modules\space\models\Space;
use humhub\modules\space\modules\manage\widgets\DefaultMenu;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\Button;
use humhub\libs\Html;

?>

<div class="panel panel-default">
    <div>
        <div class="panel-heading">
            <?= Yii::t('CommunitiesModule.manage', '<strong>Communities</strong> settings'); ?>
        </div>
    </div>

    <?php if ($contentContainer instanceof Space) : ?>
        <?= DefaultMenu::widget(['space' => $contentContainer]); ?>
    <?php endif; ?>

    <div class="panel-body">
        <p>Legen Sie hier fest, zu welchen Communities dieser Space zugeordnet werden soll.</p>
        <?php $form = ActiveForm::begin(['options' => ['id' => 'spaceIndexForm'], 'enableClientValidation' => true]); ?>
        <?= humhub\modules\space\widgets\SpacePickerField::widget([
            'form' => $form,
            'model' => $model,
            'attribute' => 'communitiesGuid',
            'selection' => $model->spaces,
        ]) ?>

        <?= Button::primary(Yii::t('base', 'Save'))->submit(); ?>
        <?php ActiveForm::end(); ?>
    </div>

</div>

<?= Html::beginTag('script'); ?>

<?= Html::endTag('script'); ?>