<?php

namespace Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
abstract class HeaderCell
{

    /**
     * @var IColumn
     */
    protected $column;

    public function __construct(IColumn $column)
    {
        $this->column = $column;
    }

    abstract public function create();

}