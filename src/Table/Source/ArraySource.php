<?php
/**
 * Mesour Table Component
 *
 * @license LGPL-3.0 and BSD-3-Clause
 * @copyright (c) 2015 Matous Nemec <matous.nemec@mesour.com>
 */

namespace Mesour\Table\Source;

use Mesour\Components\Exception;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour Table Component
 */
class ArraySource implements ISource
{

    /**
     * @var Select
     */
    protected $select;

    protected $data_arr = array();

    /**
     * @param array $data
     * @throws \Mesour\Components\Exception.
     */
    public function __construct(array $data)
    {
        if (!class_exists('\Mesour\ArrayManage\Searcher\Select')) {
            throw new Exception('Array data source required composer package "mesour/array-manager".');
        }
        $this->data_arr = $data;
        $this->select = new \Mesour\ArrayManage\Searcher\Select($data);
    }

    /**
     * Get array data count
     *
     * @return Integer
     */
    public function getTotalCount()
    {
        return $this->select->getTotalCount();
    }

    public function where($column, $value = NULL, $condition = NULL, $operator = 'and')
    {
        $this->select->where($column, $value, $condition, $operator);
    }

    /**
     * Apply limit and offset
     *
     * @param Integer $limit
     * @param Integer $offset
     */
    public function applyLimit($limit, $offset = 0)
    {
        $this->select->limit($limit);
        $this->select->offset($offset);
    }

    /**
     * Get count after applied where
     *
     * @return Integer
     */
    public function count()
    {
        return $this->select->count();
    }

    /**
     * Get searched values witp applied limit, offset and where
     *
     * @return Array
     */
    public function fetchAll()
    {
        return $this->select->fetchAll();
    }

    public function orderBy($row, $sorting = 'ASC')
    {
        $this->select->orderBy($row, $sorting);
    }

    /**
     * Return first element from data
     *
     * @return Array
     */
    public function fetch()
    {
        $data = $this->select->fetch();
        return !$data ? array() : $data;
    }

}
