<?php

namespace Mesour\EditableTests;

use Mesour\UI\Table;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

class PatternRenderTest extends BaseTestCase
{

	public function testDefault()
	{
		$table = new Table();

		$data = [
			[
				'id' => 1,
				'group_id' => 1,
				'method' => 'setName',
				'params' => '$name',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set column name.',
			],
			[
				'id' => 2,
				'group_id' => 2,
				'method' => 'setHeader',
				'params' => '$header',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set header text.',
			],
			[
				'id' => 3,
				'group_id' => 1,
				'method' => 'setCallback',
				'params' => '$callback',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set render callback.',
			],
		];

		$source = new \Mesour\Sources\ArraySource(
			'methods',
			'id',
			$data,
			[
				'groups' => [
					[
						'id' => 1,
						'name' => 'Test 1',
					],
					[
						'id' => 2,
						'name' => 'Test 2',
					],
				],
			]
		);
		$table->setSource($source);

		$dataStructrure = $source->getDataStructure();

		$groupsStructure = $dataStructrure->getOrCreateTableStructure('groups', 'id');
		$groupsStructure->addNumber('id');
		$groupsStructure->addText('name');

		$dataStructrure->addNumber('id');
		$dataStructrure->addText('method');
		$dataStructrure->addText('params');
		$dataStructrure->addText('returns');
		$dataStructrure->addText('description');
		$dataStructrure->addManyToOne('group', 'groups', 'group_id', '{name}');

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

		$table->addColumn('group', 'Group');

		$table->addColumn('description', 'Description');

		Assert::same(
			file_get_contents(__DIR__ . '/data/PatternRenderTestOutput.html'),
			(string) $table->render(),
			'Output of table render doest not match'
		);
	}

}

$test = new PatternRenderTest();
$test->run();
