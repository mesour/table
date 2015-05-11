<?php

namespace Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
abstract class Cell
{

    protected $rowData;

    /**
     * @var IColumn
     */
    protected $column;

    public function __construct($rowData, IColumn $column)
    {
        $this->rowData = $rowData;
        $this->column = $column;
    }

    abstract public function create();

}