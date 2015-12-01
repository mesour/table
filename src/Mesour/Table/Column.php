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
use Mesour\Components\Html;
use Mesour\Components\IString;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Column extends BaseColumn
{

    const NO_CALLBACK = 'mesour@no-callback';

    /**
     * Called automatically in renderer
     * @var array
     */
    public $onRender = [];

    private $header = NULL;

    private $callback;

    public function setHeader($header)
    {
        $this->header = $this->getTranslator()->translate($header);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHeader()
    {
        return $this->header;
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
        return Html::el('span', !$this->header ? $this->getName() : $this->header);
    }

    public function getBodyAttributes($data, $need = TRUE, $rawData = [])
    {
        if (
            $need
            && !isset($data[$this->getName()])
            && (array_key_exists($this->getName(), $data) && !is_null($data[$this->getName()]))
        ) {
            throw new Exception('Column with name ' . $this->getName() . ' does not exists in data source.');
        }
        return parent::getBodyAttributes($data);
    }

    /**
     * @param $data
     * @param array $rawData
     * @return string|IString
     */
    public function getBodyContent($data, $rawData)
    {
        $fromCallback = $this->tryInvokeCallback([$rawData, $this]);
        if ($fromCallback !== self::NO_CALLBACK) {
            return $fromCallback;
        }
        return ($data[$this->getName()] instanceof \DateTime ? $data[$this->getName()]->format('U') : $data[$this->getName()]);
    }

    /**
     * @param array $args
     * @return int|mixed
     */
    protected function tryInvokeCallback(array $args = [])
    {
        return $this->callback ? Helper::invokeArgs($this->callback, $args) : self::NO_CALLBACK;
    }

}
