<?php

namespace VittDigital\humhub\modules\communities\widgets;

use humhub\components\Widget;
use humhub\modules\space\models\Space;
use Yii;
use VittDigital\humhub\modules\communities\models\Community;
use humhub\modules\space\models\Membership;

/**
 * Used to render a single space chooser result.
 *
 */
class SpaceChooserItem extends Widget
{
  /**
   * @var Space
   */
  public $space;

  /**
   * @var integer
   */
  public $updateCount = 0;

  /**
   * @var boolean
   */
  public $visible = true;

  /**
   * If true the item will be marked as a following space
   * @var boolean
   */
  public $isFollowing = false;

  /**
   * If true the item will be marked as a member space
   * @var string
   */
  public $isMember = false;

  /**
   * Set to true if the space has children
   * @var bool
   */
  public $haschildren = false;

  /**
   * Specifies the identation if this is a child space of a community
   * @var integer
   */
  public $indentation = 0;

  public function run()
  {
    $data = $this->getDataAttribute();
    $badge = $this->getBadge();
    $view = 'spaceChooserItem';

    $parentcommunities = Community::findAll([
      "parent_id" => $this->space->guid,
    ]);

    $childcommunities = Community::findAll([
      "child_id" => $this->space->guid,
    ]);

    if (!empty($parentcommunities)) {
      $this->haschildren = true;
      $view = 'spaceChooserCommunityItem';
    }

    if (!empty($childcommunities)) {
      $view = 'spaceChooserSubItem';
    }

    $renderresult = $this->render($view, [
      'space' => $this->space,
      'updateCount' => $this->updateCount,
      'visible' => $this->visible,
      'badge' => $badge,
      'data' => $data,
      'indentation' => $this->indentation,
    ]);

    foreach ($parentcommunities as $community) {
      // Get all children of this community
      $space = Space::findByGuid($community->child_id);
      $childmembership = Membership::findOne([
        "space_id" => $space->id,
      ]);

      // Add render of child space to result
      if (!empty($childmembership)) {
        $renderresult .= SpaceChooserItem::widget([
          "space" => $childmembership->space,
          "updateCount" => $childmembership->countNewItems(),
          "isMember" => true,
          "indentation" => ($this->indentation += 1),
        ]);
      }
    }

    return $renderresult;
  }

  public function getBadge()
  {
    if ($this->isFollowing) {
      return '<i class="fa fa-star badge-space pull-right type tt" title="' .
        Yii::t('SpaceModule.chooser', 'You are following this space') .
        '" aria-hidden="true"></i>';
    } elseif ($this->space->isArchived()) {
      return '<i class="fa fa-history badge-space pull-right type tt" title="' .
        Yii::t('SpaceModule.chooser', 'This space is archived') .
        '" aria-hidden="true"></i>';
    }
  }

  public function getDataAttribute()
  {
    if ($this->isMember) {
      return 'data-space-member';
    } elseif ($this->isFollowing) {
      return 'data-space-following';
    } elseif ($this->space->isArchived()) {
      return 'data-space-archived';
    } else {
      return 'data-space-none';
    }
  }
}
