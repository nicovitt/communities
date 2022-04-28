<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace VittITServices\humhub\modules\communities\views\space;

use humhub\components\Widget;
use humhub\modules\space\models\Space;

/**
 * SpaceInfoCard shows a space on communities directory
 * 
 * @since 1.9
 * @author Luke
 */
class SpaceInfoCard extends Widget
{

    /**
     * @var Space
     */
    public $space;

    /**
     * @var string HTML wrapper around card
     */
    public $template = '<div class="card card-space col-lg-4 col-md-4 col-sm-6 col-xs-12">{card}</div>';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $card = $this->render('spaceInfoCardView', [
            'space' => $this->space
        ]);

        return str_replace('{card}', $card, $this->template);
    }

}
