<?php
/**
 * Mesour Table Component
 *
 * @license LGPL-3.0 and BSD-3-Clause
 * @copyright (c) 2015 Matous Nemec <matous.nemec@mesour.com>
 */

namespace Mesour\Table;

use Mesour\Components\Exception;
use Mesour\Components\Helper;
use Mesour\Table\Render\IColumn;
use Mesour\Table\Render\IRendererFactory;
use Mesour\Table\Render\Table\RendererFactory;
use Mesour\Table\Source\ISource;
use Mesour\UI\Control;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour Table Component
 */
abstract class BaseColumn extends Control implements IColumn
{

    /**
     * @var array
     */
    protected $attributes = array();

    public function setAttributes(array $attributes = array())
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setAttribute($key, $value, $append = FALSE)
    {
        Helper::createAttribute($this->attributes, $key, $value, $append);
        return $this;
    }

    public function getHeaderAttributes() {
        return array();
    }

    public function getBodyAttributes($data) {
        return $this->attributes;
    }

}
