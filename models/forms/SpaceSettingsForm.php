<?php

namespace VittDigital\humhub\modules\communities\models\forms;

use VittDigital\humhub\modules\communities\models\Community;
use humhub\modules\space\models\Space;
use yii\base\Model;
use Yii;

class SpaceSettingsForm extends Model
{

    public $communitiesGuid = [];
    public $communities = [];
    public $spaces = [];

    private $contentContainerId;

    public function __construct($contentContainerId)
    {
        $this->contentContainerId = $contentContainerId;
        $this->communities = Community::findAll(['child_id' => $this->contentContainerId]);
        foreach ($this->communities as $community) {
            //Get the space-object to make the picker work.
            $this->findspaces($community);
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
    }

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return [
            ['communitiesGuid', 'checkSpaceGuid'],
            // [['child_id'], 'required', 'string', 'max' => 45, 'min' => 2],
            // [['parent_id'], 'required', 'string', 'max' => 45, 'min' => 2],
        ];
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return [
            'communitiesGuid' => Yii::t('CommunitiesModule.space', 'Community'),
        ];
    }

    /**
     * This validator function checks the communitiesGuid.
     * @param type $attribute
     * @param type $params
     */
    public function checkSpaceGuid($attribute, $params)
    {
        // $this->spaces = Space::find()->where(['not in', 'guid', $contentContainerId])->all();
        if (!empty($this->communitiesGuid)) {
            foreach ($this->communitiesGuid as $spaceGuid) {
                if ($spaceGuid != "") {
                    $space = \humhub\modules\space\models\Space::findOne(['guid' => $spaceGuid]);
                    if ($space == null) {
                        $this->addError($attribute, Yii::t('CommunitiesModule.space', "Invalid space"));
                    }
                }
            }
        }
    }

    public function save()
    {
        // $community = Community::findOne(['child_id' => $this->contentContainerId, 'parent_id' => $communitiesguid]);
        // Remove all instances to populate it afterwards with the selected spaces.
        Community::deleteAll(['child_id' => $this->contentContainerId]);
        $this->spaces = [];
        if (!empty($this->communitiesGuid)) {
            foreach ($this->communitiesGuid as $communitiesguid) {
                // Do not add the space to itself.
                if (($communitiesguid != $this->contentContainerId) && $this->validate()) {
                    // Add new Community
                    $community = new Community();
                    $community->child_id = $this->contentContainerId;
                    $community->parent_id = $communitiesguid;

                    $space = \humhub\modules\space\models\Space::findOne(['guid' => $communitiesguid]);
                    $community->alias_name = $space->name;

                    $community->save();
                    $this->findspaces($community);
                }
            }
        }
    }

    private function findspaces($community)
    {
        $space = Space::findOne(['guid' => $community->parent_id]);
        if (!is_null($space)) {
            array_push($this->spaces, $space);
        }
    }
}
