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
abstract class HeaderCell
{

	/**
	 * @var IColumn
	 */
	protected $column;

	public function __construct(IColumn $column)
	{
		$this->column = $column;
	}

	abstract public function create();

}
