<?php

namespace Mesour\Table\Render;
use Mesour\Components\Helper;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
abstract class Attributes
{

    /**
     * @var array
     */
    protected $attributes = [];

    public function setAttributes(array $attributes = [])
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setAttribute($key, $value, $append = FALSE)
    {
        Helper::createAttribute($this->attributes, $key, $value, $append);
        return $this;
    }

}