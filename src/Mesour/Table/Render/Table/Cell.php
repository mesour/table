<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Events;
use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class Cell extends Render\Cell
{

    public function create()
    {
        if($this->column instanceof Events && isset($this->column->onRender)) {
            $this->column->onRender($this->rowData, $this->column);
        }
        $attributes = $this->column->getBodyAttributes($this->rowData);
        if ($attributes === FALSE) {
            return '';
        }
        $td = Html::el('td', $attributes);
        $content = $this->column->getBodyContent($this->rowData);

        if (!is_null($content)) {
            $td->setHtml($content);
        }
        return $td;
    }

}