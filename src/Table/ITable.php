<?php

namespace Mesour\Table;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
interface ITable
{

    /**
     * @param mixed $source
     * @return mixed
     */
    public function setSource($source);

    public function render();

}