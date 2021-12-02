<?php

namespace VittITServices\humhub\modules\communities\models\forms;

use VittITServices\humhub\modules\communities\models\Community;
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
            $tmpspace = Space::findOne(['guid' => $community->parent_id]);
            if(!is_null($tmpspace)){
                array_push($this->spaces, $tmpspace);
            }
            // array_push($this->communitiesGuid, $community->parent_id);
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
            [['child_id'], 'required', 'string', 'max' => 45, 'min' => 2],
            [['parent_id'], 'required', 'string', 'max' => 45, 'min' => 2],
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
        // Remove all instances if no space is selected
        if (empty($this->communitiesGuid)) {
            Community::deleteAll(['child_id' => $this->contentContainerId]);
        } else {
            foreach ($this->communitiesGuid as $communitiesguid) {
                $space = Community::findOne(['child_id' => $this->contentContainerId, 'parent_id' => $communitiesguid]);
                if (is_null($space)) {
                    // Add new Community
                    if($this->validate()){
                        $space = new Community();
                        $space->child_id = $this->contentContainerId;
                        $space->parent_id = $communitiesguid;
                        $x = $space->save();
                    }
                    return false;
                } else {
                    // Edit existing Community
                }
            }
        }
        return true;
    }
}
