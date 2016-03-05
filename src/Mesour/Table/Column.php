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

	private $header = null;

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
	 * @throws Mesour\InvalidArgumentException
	 */
	public function setCallback($callback)
	{
		Mesour\Components\Utils\Helpers::checkCallback($callback);
		$this->callback = $callback;
		return $this;
	}

	/**
	 * @return string|Mesour\Components\Utils\IString
	 */
	public function getHeaderContent()
	{
		return Mesour\Components\Utils\Html::el('span', !$this->header ? $this->getName() : $this->header);
	}

	public function getBodyAttributes($data, $need = true, $rawData = [])
	{
		if (
			$need
			&& !isset($data[$this->getName()])
			&& (array_key_exists($this->getName(), $data) && !is_null($data[$this->getName()]))
		) {
			throw new Mesour\OutOfRangeException('Column with name ' . $this->getName() . ' does not exists in data source.');
		}
		return parent::getBodyAttributes($data);
	}

	/**
	 * @param $data
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
		return $content;
	}

	/**
	 * @param array $args
	 * @return int|mixed
	 */
	protected function tryInvokeCallback(array $args = [])
	{
		return $this->callback ? Mesour\Components\Utils\Helpers::invokeArgs($this->callback, $args) : self::NO_CALLBACK;
	}

}
