<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\VittITServices\humhub\modules\communities\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('CommunitiesModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("communities", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t('CommunitiesModule.base', 'Hi there {name}!', ["name" => $displayName])
    ]
])

?>

<div class="panel-heading"><strong>Communities</strong> <?= Yii::t('CommunitiesModule.base', 'overview') ?></div>

<div class="panel-body">
    <p><?= Yii::t('CommunitiesModule.base', 'Hello World!') ?></p>

    <?=  Button::primary(Yii::t('CommunitiesModule.base', 'Say Hello!'))->action("communities.hello")->loader(false); ?></div>
