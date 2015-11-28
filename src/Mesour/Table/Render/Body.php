<?php

namespace Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
abstract class Body extends Attributes
{

    /**
     * @var array
     */
    protected $rows = [];

    public function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    abstract public function create();

}