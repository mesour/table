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
class Column extends BaseColumn
{

	const NO_CALLBACK = 'mesour@no-callback';

	/**
	 * Called automatically in renderer
	 * @var array
	 */
	public $onRender = [];

	private $header = null;

	private $callback;

	/**
	 * @var IListRenderer
	 */
	private $listRenderer;

	public function setHeader($header)
	{
		$this->header = $header;
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
	 * @param callable $callback callable
	 * @return $this
	 * @throws Mesour\InvalidArgumentException
	 */
	public function setCallback($callback)
	{
		Mesour\Components\Utils\Helpers::checkCallback($callback);
		$this->callback = $callback;
		return $this;
	}

	/**
	 * @return IListRenderer
	 */
	public function getListRenderer()
	{
		if (!$this->listRenderer) {
			$this->setListRenderer(new ListRenderer($this));
		}
		return $this->listRenderer;
	}

	public function setListRenderer(IListRenderer $renderer)
	{
		$this->listRenderer = $renderer;
		return $this;
	}

	/**
	 * @return string|Mesour\Components\Utils\IString
	 */
	public function getHeaderContent()
	{
		$header = !$this->header ? $this->getName() : $this->header;
		return Mesour\Components\Utils\Html::el('span', $this->getTranslator()->translate($header));
	}

	public function getBodyAttributes($data, $need = true, $rawData = [])
	{
		if (
			$need
			&& !isset($data[$this->getName()])
			&& (array_key_exists($this->getName(), $data) && !is_null($data[$this->getName()]))
		) {
			throw new Mesour\OutOfRangeException(
				'Column with name ' . $this->getName() . ' does not exists in data source.'
			);
		}
		return parent::getBodyAttributes($data);
	}

	/**
	 * @param mixed $data
	 * @param array $rawData
	 * @return string|Mesour\Components\Utils\IString
	 */
	public function getBodyContent($data, $rawData)
	{
		$fromCallback = $this->tryInvokeCallback([$rawData, $this]);
		if ($fromCallback !== self::NO_CALLBACK) {
			return $fromCallback;
		}
		$content = $data[$this->getName()];
		if ($content instanceof \DateTime) {
			return $content->format('U');
		}

		if (is_array($content)) {
			return $this->renderListContent($content);
		}

		return !$content ? '' : $content;
	}

	/**
	 * @return bool
	 */
	public function isReferencedColumn()
	{
		$dataStructure = $this->getTable()->getSource()->getDataStructure();
		if ($dataStructure->hasColumn($this->getName())) {
			$column = $dataStructure->getColumn($this->getName());
			if ($column instanceof Mesour\Sources\Structures\Columns\BaseTableColumnStructure) {
				return true;
			}
		}
		return false;
	}

	/**
	 * @param mixed $content
	 * @return IListRenderer|string
	 */
	protected function renderListContent($content)
	{
		$list = clone $this->getListRenderer();

		if (count($content) > 0) {
			foreach ($content as $contentItem) {
				$column = clone $this;
				$column->setName('_pattern');
				$list->addItem($contentItem, $column->getBodyContent($contentItem, []));
			}
			return $list;
		} else {
			if ($this->isReferencedColumn()) {
				return $list;
			}
			return '';
		}
	}

	/**
	 * @param array $args
	 * @return int|mixed
	 */
	protected function tryInvokeCallback(array $args = [])
	{
		return $this->callback ? Mesour\Components\Utils\Helpers::invokeArgs(
			$this->callback,
			$args
		) : self::NO_CALLBACK;
	}

}
