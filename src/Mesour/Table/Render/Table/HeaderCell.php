<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Table;

use Mesour;
use Mesour\Table\Render;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class HeaderCell extends Render\HeaderCell
{

    public function create()
    {
        $attributes = $this->column->getHeaderAttributes();
        if ($attributes === FALSE) {
            return '';
        }
        $td = Mesour\Components\Utils\Html::el('th', $attributes);
        $td->setHtml($this->column->getHeaderContent());
        return $td;
    }

}