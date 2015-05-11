<?php

namespace Mesour\Table\Source;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
interface ISource
{

    /**
     * Get total count without apply where and limit
     */
    public function getTotalCount();

    /**
     * Add where condition
     *
     * @param Mixed $args
     */
    public function where($args);

    /**
     * Apply limit and offset
     *
     * @param Integer $limit
     * @param Integer $offset
     */
    public function applyLimit($limit, $offset = 0);

    /**
     * Get count with applied where without limit
     *
     * @return Integer
     */
    public function count();

    /**
     * Get data with applied where, limit and offset
     *
     * @return mixed
     */
    public function fetchAll();

    /**
     * Get first element from data
     *
     * @return mixed
     */
    public function fetch();

    /**
     * Selects columns to order by.
     *
     * @param String $row
     * @param String $sorting sorting direction
     * @return void
     */
    public function orderBy($row, $sorting = 'ASC');

}