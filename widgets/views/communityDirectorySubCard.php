<?php

use humhub\libs\Html;
use humhub\modules\space\models\Space;
use humhub\modules\space\widgets\Image;
use humhub\modules\space\widgets\SpaceDirectoryActionButtons;
use humhub\modules\space\widgets\SpaceDirectoryIcons;
use humhub\modules\space\widgets\SpaceDirectoryStatus;
use humhub\modules\space\widgets\SpaceDirectoryTagList;
use humhub\modules\space\widgets\SpaceDirectoryCard;
use yii\web\View;
use VittDigital\humhub\modules\communities\widgets\CommunitiesDirectoryCard;

/* @var $this View */
/* @var $space Space */
?>

<div class="card-panel<?php if (
                        $space->isArchived()
                      ) : ?> card-archived<?php endif; ?>">
  <div class="card-body">
    <strong class="card-title"><?= Html::containerLink($space) ?></strong>
    <?= SpaceDirectoryTagList::widget([
      'space' => $space,
      'template' => '<div class="card-tags">{tags}</div>',
    ]) ?>
  </div>
</div>

<!-- <div class="subcards subcards-container" style="display: flex; flex-direction: column;"> -->
<?php foreach ($children as $child) {
  $subspaceobject = Space::findByGuid($child->child_id);
  echo CommunitiesDirectoryCard::widget([
    'space' => $subspaceobject,
    'indentation' => $indentation,
    'parentspace_id' => $space->guid,
  ]);
} ?>
<!-- </div> -->