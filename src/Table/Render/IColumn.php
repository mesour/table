<?php

namespace Mesour\Table\Render;

use Mesour\Components\IString;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour DataGrid
 */
interface IColumn
{

    public function setName($name);

    public function getName();

    public function setHeader($header);

    /**
     * @return array
     */
    public function getHeaderAttributes();

    /**
     * @return string|IString
     */
    public function getHeaderContent();

    /**
     * @param $data
     * @return array
     */
    public function getBodyAttributes($data);

    /**
     * @param $data
     * @return string|IString
     */
    public function getBodyContent($data);

}