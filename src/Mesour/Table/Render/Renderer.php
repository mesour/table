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
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
abstract class Renderer extends Attributes
{

	/**
	 * @var Header
	 */
	protected $header;

	/**
	 * @var Body
	 */
	protected $body;

	public function setBody(Body $body)
	{
		$this->body = $body;
	}

	public function setHeader(Header $header)
	{
		$this->header = $header;
	}

	abstract public function create();

}