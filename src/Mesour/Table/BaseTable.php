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
use Mesour\Components\InvalidArgumentException;
use Mesour\Sources\ArraySource;
use Mesour\Sources\ISource;
use Mesour\Table\Render\IRendererFactory;
use Mesour\Table\Render\Table\RendererFactory;
use Mesour\UI\Control;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
abstract class BaseTable extends Control implements ITable
{

    /**
     * @var IRendererFactory
     */
    private $rendererFactory;

    protected $isRendererUsed = FALSE;

    /**
     * @var \Mesour\Sources\ISource
     */
    private $source;

    protected $isSourceUsed = FALSE;

    /**
     * @param mixed $source
     * @return $this
     * @throws Exception
     */
    public function setSource($source)
    {
        if ($this->isSourceUsed) {
            throw new Exception('Cannot change source after using them.');
        }
        if (!$source instanceof ISource) {
            if (is_array($source)) {
                $source = new ArraySource($source);
            } else {
                throw new InvalidArgumentException('Source must be instance of ' . ISource::class . ' or array.');
            }
        }
        $this->source = $source;
        return $this;
    }

    /**
     * @return ISource
     * @throws Exception
     */
    public function getSource()
    {
        if (!$this->source) {
            throw new Exception('Data source is not set.');
        }
        $this->isSourceUsed = TRUE;
        return $this->source;
    }

    /**
     * @param IRendererFactory $rendererFactory
     * @return $this
     * @throws Exception
     */
    public function setRendererFactory(IRendererFactory $rendererFactory)
    {
        if ($this->isRendererUsed) {
            throw new Exception('Cannot change renderer after using them.');
        }
        $this->rendererFactory = $rendererFactory;
        return $this;
    }

    /**
     * @return IRendererFactory|RendererFactory
     */
    protected function getRendererFactory()
    {
        if (!$this->rendererFactory) {
            $this->rendererFactory = new RendererFactory();
        }
        $this->isRendererUsed = TRUE;
        return $this->rendererFactory;
    }

}
