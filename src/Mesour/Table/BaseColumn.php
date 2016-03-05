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
abstract class BaseColumn extends Mesour\Components\Control\AttributesControl implements Mesour\Table\Render\IColumn
{

	/**
	 * @param null $sub_control
	 * @return \Mesour\UI\Control
	 * @throws Mesour\InvalidStateException
	 */
	public function getTable($sub_control = null)
	{
		$table = $this->lookup(ITable::class, false, true);
		if (!$table instanceof ITable) {
			throw new Mesour\InvalidStateException('Column is not attached to Table.');
		}
		if (is_null($sub_control)) {
			return $table;
		} else {
			return $table[$sub_control];
		}
	}

	public function getHeaderAttributes()
	{
		return [];
	}

	public function getBodyAttributes($data, $need = true, $rawData = [])
	{
		$this->setOption('data', $data);
		$this->setOption('rawData', $rawData);
		return $this->getAttributes();
	}

}
