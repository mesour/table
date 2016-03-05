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
interface ITable extends Mesour\Components\ComponentModel\IContainer
{

	/**
	 * @param mixed $source
	 * @return mixed
	 */
	public function setSource($source);

	public function render();

}