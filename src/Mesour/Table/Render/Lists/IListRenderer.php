<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Lists;

use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 */
interface IListRenderer extends Mesour\Components\Utils\IString
{

	/**
	 * @param callable $callable
	 * @return mixed
	 */
	public function setCallback($callable);

	/**
	 * @param array|mixed $contentItem
	 * @param string $content
	 * @param array|mixed $data
	 * @return mixed
	 */
	public function addItem($contentItem, $content, $data);

	/**
	 * @return Mesour\Components\Utils\Html
	 */
	public function getWrapperPrototype();

	/**
	 * @return bool
	 */
	public function isEmpty();

	/**
	 * @return array
	 */
	public function getItems();

	/**
	 * @return Mesour\Components\Utils\Html
	 */
	public function render();

}
