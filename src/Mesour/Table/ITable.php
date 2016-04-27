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
interface ITable extends Mesour\Components\ComponentModel\IContainer
{

	/**
	 * @param Mesour\Sources\ISource $source
	 * @return mixed
	 */
	public function setSource(Mesour\Sources\ISource $source);

	/**
	 * @return Mesour\Sources\ISource
	 */
	public function getSource();

	/**
	 * @param Mesour\Table\Render\IRendererFactory $rendererFactory
	 * @return mixed
	 * @throws Mesour\InvalidStateException
	 */
	public function setRendererFactory(Mesour\Table\Render\IRendererFactory $rendererFactory);

	public function setAttributes(array $attributes = []);

	public function setAttribute($key, $value, $append = false);

	/**
	 * @param string $name
	 * @param null $header
	 * @return Mesour\Table\Column
	 */
	public function addColumn($name, $header = null);

	/**
	 * @return Mesour\Components\ComponentModel\IContainer[]
	 */
	public function getColumns();

	public function render();

}
