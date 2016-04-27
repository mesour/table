<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render\Table;

use Mesour;
use Mesour\Table\Render;

/**
 * @author Matouš Němec (http://mesour.com)
 */
class Row extends Render\Row
{

	public function create()
	{
		$tr = Mesour\Components\Utils\Html::el('tr', $this->attributes);
		foreach ($this->cells as $cell) {
			$tr->add($cell->create());
		}
		return $tr;
	}

}
