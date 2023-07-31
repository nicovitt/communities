<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace VittDigital\humhub\modules\communities\models;

use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\space\components\UrlValidator;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\space\models\Space;
use VittDigital\humhub\modules\communities\components\ActiveQueryCommunity;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "communities_community".
 *
 * @property integer $id
 * @property string $child_id
 * @property string $parent_id
 * @property string $alias_name
 *
 */
class Community extends ActiveRecord
{
    // Model Scenarios
    // const SCENARIO_CREATE = 'create';
    // const SCENARIO_EDIT = 'edit';
    // const SCENARIO_SECURITY_SETTINGS = 'security_settings';

    /**
     * @var string id of the space
     */
    // public $child_id;

    /**
     * @var string id of the parents space
     */
    // public $parent_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communities_community';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            // [['child_id'], 'required', 'string', 'max' => 45, 'min' => 2],
            // [['parent_id'], 'required', 'string', 'max' => 45, 'min' => 2],
        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'child_id' => 'Kindelement',
            'parent_id' => 'Community',
            'alias_name' => 'Aliasname'
        ];
    }


    public function attributeHints()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Yii::$app->queue->push(new UpdateDocument([
        //     'activeRecordClass' => get_class($this),
        //     'primaryKey' => $this->id
        // ]));

        if ($insert) {
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        // Yii::$app->queue->push(new DeleteDocument([
        //     'activeRecordClass' => get_class($this),
        //     'primaryKey' => $this->id
        // ]));

        return parent::beforeDelete();
    }

    /**
     * @inheritdoc
     * @return ActiveQuerySpace
     */
    public static function find()
    {
        return new ActiveQueryCommunity(get_called_class());
    }
}
