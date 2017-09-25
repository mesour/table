<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2017 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render;

use Mesour;

/**
 * @author Matouš Němec (http://mesour.com)
 */
abstract class Attributes
{

	/**
	 * @var array
	 */
	protected $attributes = [];

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

}
