<?php

use humhub\modules\space\models\Space;
use VittDigital\humhub\modules\communities\views\space\SpaceInfoCard;

// Register our module assets, this could also be done within the controller
\VittDigital\humhub\modules\communities\assets\Assets::register($this);

/* @var $this View */
/* @var $communities CommunityDirectoryQuery */

$displayName = Yii::$app->user->isGuest
  ? Yii::t('CommunitiesModule.base', 'Guest')
  : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("communities", [
  'username' => Yii::$app->user->isGuest
    ? $displayName
    : Yii::$app->user->getIdentity()->username,
  'text' => [
    'hello' => Yii::t('CommunitiesModule.base', 'Hi there {name}!', [
      "name" => $displayName,
    ]),
  ],
]);
?>

<div class="row cards">
  <?php if (!$communities->exists()) : ?>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><?= Yii::t(
                    'CommunitiesModule.base',
                    'No communities found!'
                  ) ?></strong><br />
          <?= Yii::t(
            'CommunitiesModule.base',
            'Try adding your spaces into new communites.'
          ) ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <?php foreach ($communities->all() as $community) : ?>
          <div class="row-item-body">
            <li role="separator" class="divider"><strong class="row-item-title"><?= "$community->alias_name Community" ?></strong></li>
            <div class="col-md-12">
              <?php if ($community->child_id != "") : ?>
                <?= SpaceInfoCard::widget([
                  'space' => Space::findOne([
                    'guid' => $community->child_id,
                  ]),
                ]) ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="divider"><br></br></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>