<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2017 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Table;

use Mesour\Table\Render;

/**
 * @author Matouš Němec (http://mesour.com)
 */
class RendererFactory implements Render\IRendererFactory
{

	public function createHeaderCell(Render\IColumn $column)
	{
		return new HeaderCell($column);
	}

	public function createCell($data, Render\IColumn $column, $rawData)
	{
		return new Cell($data, $column, $rawData);
	}

	public function createRow($data, $rawData)
	{
		return new Row($data, $rawData);
	}

	public function createBody()
	{
		return new Body();
	}

	public function createHeader()
	{
		return new Header();
	}

	public function createTable()
	{
		return new Renderer();
	}

}
