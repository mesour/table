<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
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