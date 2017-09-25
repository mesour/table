<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2017 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render;

/**
 * @author Matouš Němec (http://mesour.com)
 */
interface IRendererFactory
{

	/**
	 * @param IColumn $column
	 * @return HeaderCell
	 */
	public function createHeaderCell(IColumn $column);

	/**
	 * @param array $data
	 * @param IColumn $column
	 * @param array $rawData
	 * @return Cell
	 */
	public function createCell($data, IColumn $column, $rawData);

	/**
	 * @param array $data
	 * @param array $rawData
	 * @return Row
	 */
	public function createRow($data, $rawData);

	/**
	 * @return Header
	 */
	public function createHeader();

	/**
	 * @return Body
	 */
	public function createBody();

	/**
	 * @return Renderer
	 */
	public function createTable();

}
