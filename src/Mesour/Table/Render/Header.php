<?php

namespace Mesour\Table\Render;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
abstract class Header extends Attributes
{

    protected $header_attributes = [];

    /**
     * @var array
     */
    protected $cells = [];

    public function addCell(HeaderCell $cell)
    {
        $this->cells[] = $cell;
    }

    public function setTHeadAttributes(array $header_attributes)
    {
        $this->header_attributes = $header_attributes;
    }

    abstract public function create();

}