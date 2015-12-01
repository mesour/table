<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table;

use Mesour\Components\Exception;
use Mesour\Components\Helper;
use Mesour\Table\Render\IColumn;
use Mesour\UI\Control;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
abstract class BaseColumn extends Control implements IColumn
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

    /**
     * @param null $sub_control
     * @return \Mesour\UI\Control
     * @throws Exception
     */
    public function getTable($sub_control = NULL)
    {
        $table = $this->lookup(ITable::class, FALSE, TRUE);
        if (!$table instanceof ITable) {
            throw new Exception('Column is not attached to Table.');
        }
        if (is_null($sub_control)) {
            return $table;
        } else {
            return $table[$sub_control];
        }
    }

    public function getHeaderAttributes()
    {
        return [];
    }

    public function getBodyAttributes($data, $need = TRUE, $rawData = [])
    {
        return $this->attributes;
    }

}
