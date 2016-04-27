<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\UI;

use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 *
 * @method null onRenderHeader(Mesour\Table\Render\Table\Header $header, $rawData, $data)
 * @method null onRender(Table $table, $rawData, $data)
 * @method null onRenderBody(Mesour\Table\Render\Table\Body $body, $rawData, $data)
 * @method null onRenderRow(Mesour\Table\Render\Table\Row $row, $rawData, $data)
 */
class Table extends Mesour\Table\BaseTable
{

	public $onRender = [];

	public $onRenderHeader = [];

	public $onRenderBody = [];

	public $onRenderRow = [];

	/**
	 * @var array
	 */
	protected $attributes = [
		'class' => 'table',
	];

	public function __construct($name = null, Mesour\Components\ComponentModel\IContainer $parent = null)
	{
		parent::__construct($name, $parent);
		$this->addComponent(new Control, 'col');
	}

	public function setAttributes(array $attributes = [])
	{
		$this->attributes = $attributes;
		return $this;
	}

	public function setAttribute($key, $value, $append = false)
	{
		Mesour\Components\Utils\Helpers::createAttribute($this->attributes, $key, $value, $append);
		return $this;
	}

	/**
	 * @param string $name
	 * @param null $header
	 * @return Mesour\Table\Column
	 */
	public function addColumn($name, $header = null)
	{
		return $this->setColumn(new Mesour\Table\Column, $name, $header);
	}

	protected function setColumn(Mesour\Table\Render\IColumn $column, $name, $header = null)
	{
		$column->setHeader($header);
		return $this['col'][$name] = $column;
	}

	/**
	 * @return Mesour\Components\ComponentModel\IContainer[]
	 */
	public function getColumns()
	{
		return $this['col'];
	}

	/**
	 * @return Mesour\Table\Render\Renderer|Mesour\Table\Render\Table\Renderer
	 */
	public function create()
	{
		parent::create();

		$renderer = $this->getRendererFactory();

		$data = $this->getSource()->fetchAll();
		$rawData = $this->getSource()->fetchLastRawRows();

		$this->onRender($this, $rawData, $data);

		$table = $renderer->createTable();

		$table->setAttributes($this->attributes);

		$header = $renderer->createHeader();

		foreach ($this->getColumns() as $column) {
			/** @var Mesour\Table\Render\IColumn $column */
			$headerCell = $renderer->createHeaderCell($column);
			$header->addCell($headerCell);
		}
		$this->onRenderHeader($header, $rawData, $data);

		$table->setHeader($header);

		$body = $renderer->createBody();

		foreach ($data as $key => $item) {
			$row = $renderer->createRow($item, $rawData[$key]);
			foreach ($this->getColumns() as $column) {
				$cell = $renderer->createCell($item, $column, $rawData[$key]);
				$row->addCell($cell);
			}
			$this->onRenderRow($row, $rawData, $item);
			$body->addRow($row);
		}

		$this->onRenderBody($body, $rawData, $data);

		$table->setBody($body);

		return $table;
	}

	public function render()
	{
		/** @var Mesour\Table\Render\Renderer $renderer */
		$renderer = parent::render();
		return $renderer->create();
	}

}
