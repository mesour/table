<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2017 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Lists;

use Mesour;
use Mesour\Table\Render\IColumn;

/**
 * @author Matouš Němec (http://mesour.com)
 *
 * @method void onRenderRow(ListRenderer $renderer, Mesour\Components\Utils\Html $li, $data, $content)
 * @method void onRender(ListRenderer $renderer, Mesour\Components\Utils\Html $wrapper)
 */
class ListRenderer extends Mesour\Object implements IListRenderer
{

	private $items = [];

	private $callback;

	/**
	 * @var Mesour\Components\Utils\Html
	 */
	private $wrapperPrototype;

	/**
	 * @var IColumn
	 */
	private $column;

	protected $liAttributes = [];

	public $onRender = [];

	public $onRenderRow = [];

	public function __construct(IColumn $column)
	{
		$this->column = $column;
	}

	/**
	 * @return callable
	 */
	protected function getCallback()
	{
		return $this->callback;
	}

	public function setCallback($callable)
	{
		$this->callback = Mesour\Components\Utils\Helpers::checkCallback($callable);
		return $this;
	}

	public function addItem($contentItem, $content, $data)
	{
		$this->items[] = [$data, $content, $data];
		return $this;
	}

	/**
	 * @return IColumn
	 */
	public function getColumn()
	{
		return $this->column;
	}

	/**
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @return bool
	 */
	public function isEmpty()
	{
		return count($this->items) === 0;
	}

	public function getWrapperPrototype()
	{
		if (!$this->wrapperPrototype) {
			$this->wrapperPrototype = Mesour\Components\Utils\Html::el('ul');
		}
		return $this->wrapperPrototype;
	}

	protected function createLiPrototype()
	{
		return Mesour\Components\Utils\Html::el('li', $this->liAttributes);
	}

	public function render()
	{
		$wrapper = $this->getWrapperPrototype();

		$this->onRender($this, $wrapper);

		foreach ($this->items as $item) {
			$li = $this->createLiPrototype();
			if ($this->callback) {
				Mesour\Components\Utils\Helpers::invokeArgs($this->callback, [$li, $item[0], $item[1]]);
			} else {
				$li->add($item[1]);
			}
			$this->onRenderRow($this, $li, $item[0], $item[1]);
			$wrapper->add($li);
		}

		return $wrapper;
	}

	public function __toString()
	{
		try {
			return (string) $this->render();
		} catch (\Exception $e) {
			trigger_error($e, E_USER_ERROR);
		}
		return '';
	}

	public function __clone()
	{
		if ($this->wrapperPrototype) {
			$this->wrapperPrototype = clone $this->wrapperPrototype;
			$this->wrapperPrototype->removeChildren();
		}
	}

}
