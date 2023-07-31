<?php

namespace VittDigital\humhub\modules\communities\widgets;

use humhub\components\Widget;
use humhub\modules\space\models\Space;
use VittDigital\humhub\modules\communities\models\Community;

/**
 * Class CommunitiesDirectoryCard
 * @package VittDigital\humhub\modules\communities\widgets
 */
class CommunitiesDirectoryCard extends Widget
{
  /**
   * @var Space
   */
  public $space;

  /**
   * @var string
   */
  public $parentspace_id = "";

  /**
   * @var string
   */
  public $template = '<div class="card card-space col-lg-3 col-md-4 col-sm-6 col-xs-12">{card}</div>';

  /**
   * Sets the children
   * @var array
   */
  public $children = [];

  /**
   * Sets the parents
   * @var array
   */
  public $parents = [];

  /**
   * Specifies the identation if this is a child space of a community
   * @var integer
   */
  public $indentation = 1;

  /**
   * @inheritdoc
   */
  public function run()
  {
    $this->children = Community::findAll([
      "parent_id" => $this->space->guid,
    ]);

    $this->parents = Community::findAll([
      "child_id" => $this->space->guid,
    ]);

    if (
      empty($this->children) &&
      empty($this->parents) &&
      empty($this->parentspace_id)
    ) {
      // Is a normal space without hierarchy settings
      $card = $this->render('communityDirectoryCard', [
        'space' => $this->space,
      ]);
      return str_replace('{card}', $card, $this->template);
    }

    if (empty($this->parents) && empty($this->parentspace_id)) {
      // Is a top level community
      $this->template =
        '<div class="card comcard-space col-lg-' .
        12 .
        ' col-md-' .
        12 .
        ' col-sm-' .
        12 .
        ' col-xs-' .
        12 .
        '">{card}</div>';
      $card = $this->render('communityDirectoryCommunityCard', [
        'space' => $this->space,
        'children' => $this->children,
        "indentation" => ($this->indentation += 1),
      ]);
      return str_replace('{card}', $card, $this->template);
    }

    if (!empty($this->parents) && !empty($this->parentspace_id)) {
      // Is a subspace
      $this->template =
        '<div class="card subcard-space col-lg-' .
        12 .
        ' col-md-' .
        12 .
        ' col-sm-' .
        12 .
        ' col-xs-' .
        12 .
        '">{card}</div>';
      $card = $this->render('communityDirectorySubCard', [
        'space' => $this->space,
        'children' => $this->children,
        "indentation" => ($this->indentation += 1),
      ]);
      return str_replace('{card}', $card, $this->template);
    }
  }
}
