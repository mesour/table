<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class Body extends Render\Body
{

    public function create()
    {
        $tableBody = Html::el('tbody', $this->attributes);

        foreach ($this->rows as $row) {
            $tableBody->add($row->create());
        }

        return $tableBody;
    }

}