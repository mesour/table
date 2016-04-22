<?php

namespace Mesour\EditableTests;

use Mesour\UI\Table;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

class DefaultTest extends BaseTestCase
{

	public function testDefault()
	{
		$table = new Table();

		$data = [
			[
				'id' => 1,
				'method' => 'setName',
				'params' => '$name',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set column name.',
			],
			[
				'id' => 2,
				'method' => 'setHeader',
				'params' => '$header',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set header text.',
			],
			[
				'id' => 3,
				'method' => 'setCallback',
				'params' => '$callback',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set render callback.',
			],
		];

		$table->setSource(new \Mesour\Sources\ArraySource('methods', 'id', $data));

		$table->onRenderRow[] = function (\Mesour\Table\Render\Table\Row $row) {
			$row->setAttribute('class', 'test-class', true);
		};

		$table->setAttribute('class', 'table table-striped table-hover');

		$table->addColumn('method', 'Method')
			->setCallback(
				function ($rawData, \Mesour\Table\Column $column) {
					return \Mesour\Components\Utils\Html::el('b')->setText($rawData['method']);
				}
			);

		$table->addColumn('params', 'Parameters');

		$table->addColumn('returns', 'Returns');

		$table->addColumn('description', 'Description');

		Assert::same(
			file_get_contents(__DIR__ . '/data/DefaultTestOutput.html'),
			(string) $table->render(),
			'Output of table render doest not match'
		);
	}

}

$test = new DefaultTest();
$test->run();
