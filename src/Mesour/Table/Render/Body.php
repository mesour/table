<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render;

/**
 * @author Matouš Němec (http://mesour.com)
 */
abstract class Body extends Attributes
{

	/** @var Row[] */
	protected $rows = [];

	public function addRow(Row $row)
	{
		$this->rows[] = $row;
	}

	abstract public function create();

}
