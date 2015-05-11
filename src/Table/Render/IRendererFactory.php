<?php

namespace Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
interface IRendererFactory
{

    /**
     * @param IColumn $column
     * @return HeaderCell
     */
    public function createHeaderCell(IColumn $column);

    /**
     * @param IColumn $column
     * @return Cell
     */
    public function createCell($rowData, IColumn $column);

    /**
     * @return Row
     */
    public function createRow($rowData);

    /**
     * @return Header
     */
    public function createHeader();

    /**
     * @return Body
     */
    public function createBody();

    /**
     * @return Renderer
     */
    public function createTable();

}