<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Renderer extends Render\Renderer
{

    public function create()
    {
        $table = Html::el('table', $this->attributes);

        $table->add($this->header->create());

        $table->add($this->body->create());

        return $table;
    }

}