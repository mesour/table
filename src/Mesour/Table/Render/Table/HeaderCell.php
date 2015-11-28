<?php

namespace Mesour\Table\Render\Table;

use Mesour\Components\Html;
use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class HeaderCell extends Render\HeaderCell
{

    public function create()
    {
        $attributes = $this->column->getHeaderAttributes();
        if ($attributes === FALSE) {
            return '';
        }
        $td = Html::el('th', $attributes);
        $td->setHtml($this->column->getHeaderContent());
        return $td;
    }

}