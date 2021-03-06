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
abstract class Header extends Attributes
{

	protected $headerAttributes = [];

	/**
	 * @var Cell[]
	 */
	protected $cells = [];

	public function addCell(HeaderCell $cell)
	{
		$this->cells[] = $cell;
	}

	public function setTHeadAttributes(array $headerAttributes)
	{
		$this->headerAttributes = $headerAttributes;
	}

	abstract public function create();

}
