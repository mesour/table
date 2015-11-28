<?php

namespace Mesour\Table\Render\Table;

use Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
class RendererFactory implements Render\IRendererFactory
{

    public function createHeaderCell(Render\IColumn $column)
    {
        return new HeaderCell($column);
    }

    public function createCell($rowData, Render\IColumn $column)
    {
        return new Cell($rowData, $column);
    }

    public function createRow($rowData)
    {
        return new Row($rowData);
    }

    public function createBody()
    {
        return new Body();
    }

    public function createHeader()
    {
        return new Header();
    }

    public function createTable()
    {
        return new Renderer();
    }

}