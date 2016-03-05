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
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
class Body extends Render\Body
{

	public function create()
	{
		$tableBody = Mesour\Components\Utils\Html::el('tbody', $this->attributes);

		foreach ($this->rows as $row) {
			$tableBody->add($row->create());
		}

		return $tableBody;
	}

}