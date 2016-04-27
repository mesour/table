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
abstract class Row extends Attributes
{

	/** @var Cell[] */
	protected $cells = [];

	protected $data;

	protected $rawData;

	/** @var Body */
	protected $body;

	public function __construct($data, $rawData)
	{
		$this->data = $data;
		$this->rawData = $rawData;
	}

	public function addCell(Cell $cell)
	{
		$this->cells[] = $cell;
	}

	public function setBody(Body $body)
	{
		$this->body = $body;
	}

	abstract public function create();

}
