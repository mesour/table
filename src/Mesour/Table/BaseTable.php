<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */
namespace Mesour\Table;

use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 */
abstract class BaseTable extends Mesour\UI\Control implements ITable
{

	/**
	 * @var Mesour\Table\Render\IRendererFactory
	 */
	private $rendererFactory;

	protected $isRendererUsed = false;

	/**
	 * @var \Mesour\Sources\ISource
	 */
	private $source;

	protected $isSourceUsed = false;

	/**
	 * @param Mesour\Sources\ISource $source
	 * @return $this
	 * @throws Mesour\InvalidStateException
	 * @throws Mesour\InvalidArgumentException
	 */
	public function setSource(Mesour\Sources\ISource $source)
	{
		if ($this->isSourceUsed) {
			throw new Mesour\InvalidStateException('Cannot change source after using them.');
		}
		$this->source = $source;
		return $this;
	}

	/**
	 * @return Mesour\Sources\ISource
	 * @throws Mesour\InvalidStateException
	 */
	public function getSource()
	{
		if (!$this->source) {
			throw new Mesour\InvalidStateException('Data source is not set.');
		}
		$this->isSourceUsed = true;
		return $this->source;
	}

	/**
	 * @param Mesour\Table\Render\IRendererFactory $rendererFactory
	 * @return $this
	 * @throws Mesour\InvalidStateException
	 */
	public function setRendererFactory(Mesour\Table\Render\IRendererFactory $rendererFactory)
	{
		if ($this->isRendererUsed) {
			throw new Mesour\InvalidStateException('Cannot change renderer after using them.');
		}
		$this->rendererFactory = $rendererFactory;
		return $this;
	}

	/**
	 * @return Mesour\Table\Render\IRendererFactory|Mesour\Table\Render\Table\RendererFactory
	 */
	protected function getRendererFactory()
	{
		if (!$this->rendererFactory) {
			$this->rendererFactory = new Mesour\Table\Render\Table\RendererFactory();
		}
		$this->isRendererUsed = true;
		return $this->rendererFactory;
	}

}
