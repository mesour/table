<?php

namespace Mesour\Table;

use Mesour\Components\IContainer;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
interface ITable extends IContainer
{

    /**
     * @param mixed $source
     * @return mixed
     */
    public function setSource($source);

    public function render();

}