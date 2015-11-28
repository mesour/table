<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class Row extends Render\Row
{

    public function create()
    {
        $tr = Html::el('tr', $this->attributes);
        foreach ($this->cells as $cell) {
            $tr->add($cell->create());
        }
        return $tr;
    }

}