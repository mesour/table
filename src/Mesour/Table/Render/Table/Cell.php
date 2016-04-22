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
class Cell extends Render\Cell
{

	public function create()
	{
		if ($this->column instanceof Mesour\Object && isset($this->column->onRender)) {
			$this->column->onRender($this->rawData, $this->column);
		}
		$attributes = $this->column->getBodyAttributes($this->data, true, $this->rawData);
		if ($attributes === false) {
			return '';
		}
		$td = Mesour\Components\Utils\Html::el('td', $attributes);
		$content = $this->column->getBodyContent($this->data, $this->rawData);

		if (!is_null($content)) {
			$td->setHtml($content);
		}
		return $td;
	}

}
