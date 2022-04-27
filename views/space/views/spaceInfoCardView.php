<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */


use humhub\libs\Html;
use humhub\modules\space\models\Space;
use humhub\modules\space\widgets\Image;
use humhub\modules\space\widgets\SpaceDirectoryActionButtons;
use humhub\modules\space\widgets\SpaceDirectoryIcons;
use humhub\modules\space\widgets\SpaceDirectoryStatus;
use humhub\modules\space\widgets\SpaceDirectoryTagList;
use yii\web\View;

/* @var $this View */
/* @var $space Space */
?>

<div class="card-panel<?php if ($space->isArchived()) : ?> card-archived<?php endif; ?>">
    <div class="card-bg-color" style="background-color: Red"></div>
    <div class="card-body">
        <div class="line">- <strong class="card-title"><?= Html::containerLink($space); ?></strong></div>
        
    </div>
    <!-- <?= SpaceDirectoryActionButtons::widget([
        'space' => $space,
        'template' => '<div class="card-footer">{buttons}</div>',
    ]); ?> -->
</div>