<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class Header extends Render\Header
{

    public function create()
    {
        $tableHead = Html::el('thead', $this->header_attributes);
        $tr = Html::el('tr', $this->attributes);
        foreach ($this->cells as $cell) {
            $tr->add($cell->create());
        }
        $tableHead->add($tr);
        return $tableHead;
    }

}