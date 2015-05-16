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
use Mesour\Components\IString;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour Table Component
 */
class Column extends BaseColumn
{

    /**
     * Called automatically in renderer
     * @var array
     */
    public $onRender = array();

    private $header;

    private $callback;

    public function setHeader($header)
    {
        $this->header = $this->getTranslator()->translate($header);
        return $this;
    }

    /**
     * @param $callback  callable
     * @return $this
     * @throws \Mesour\Components\InvalidArgumentException
     */
    public function setCallback($callback)
    {
        Helper::checkCallback($callback);
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return string|IString
     */
    public function getHeaderContent()
    {
        return !$this->header ? $this->getName() : $this->header;
    }

    public function getBodyAttributes($data)
    {
        if (!isset($data[$this->getName()])) {
            throw new Exception('Column with name ' . $this->getName() . ' does not exists in data source.');
        }
        return parent::getBodyAttributes($data);
    }

    /**
     * @param $data
     * @return string|IString
     */
    public function getBodyContent($data)
    {
        return $this->callback ? Helper::invokeArgs($this->callback, array($data, $this)) : $data[$this->getName()];
    }

}
