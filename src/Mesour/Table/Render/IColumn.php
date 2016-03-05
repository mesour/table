<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\Table\Render;

use Mesour;


/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 */
interface IColumn extends Mesour\Components\ComponentModel\IContainer
{

	public function setName($name);

	public function getName();

	public function setHeader($header);

	public function getHeader();

	/**
	 * @return array
	 */
	public function getHeaderAttributes();

	/**
	 * @return string|Mesour\Components\Utils\IString
	 */
	public function getHeaderContent();

	/**
	 * @param $data
	 * @param bool|TRUE $need
	 * @param array $rawData
	 * @return array
	 */
	public function getBodyAttributes($data, $need = true, $rawData = []);

	/**
	 * @param $data
	 * @param array $rawData
	 * @return string|Mesour\Components\Utils\IString
	 */
	public function getBodyContent($data, $rawData);

}