<?php

namespace Mesour\EditableTests;

use Mesour\UI\Table;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

class ListRendererTest extends BaseTestCase
{

	public function testDefault()
	{
		$table = new Table();

		$data = [
			[
				'id' => 1,
				'group_id' => 1,
				'method' => 'setName',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set column name.',
			],
			[
				'id' => 2,
				'group_id' => 2,
				'method' => 'setHeader',
				'returns' => 'Mesour\Table\Column',
				'description' => 'Set header text.',
			],
			[
				'id' => 3,
				'group_id' => 1,
				'method' => 'setCallback',
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
				'parameters' => [
					['id' => 1, 'method_id' => 1, 'name' => '$name'],
					['id' => 2, 'method_id' => 1, 'name' => '$identifier'],
					['id' => 3, 'method_id' => 3, 'name' => 'array $data'],
				],
				'types' => [
					['id' => 1, 'name' => 'first', 'verified' => 0],
					['id' => 2, 'name' => 'second', 'verified' => 1],
					['id' => 3, 'name' => 'third', 'verified' => 0],
				],
				'method_types' => [
					['method_id' => 1, 'type_id' => 1],
					['method_id' => 1, 'type_id' => 2],
					['method_id' => 1, 'type_id' => 3],
					['method_id' => 2, 'type_id' => 2],
				],
			]
		);
		$table->setSource($source);

		$dataStructure = $source->getDataStructure();

		$groupsStructure = $dataStructure->getOrCreateTableStructure('groups', 'id');
		$groupsStructure->addNumber('id');
		$groupsStructure->addText('name');

		$dataStructure->addNumber('id');
		$dataStructure->addText('method');
		$dataStructure->addText('returns');
		$dataStructure->addText('description');
		$dataStructure->addManyToOne('group', 'groups', 'group_id', '{name}');

		$groupsStructure = $dataStructure->getOrCreateTableStructure('types', 'id');
		$groupsStructure->addNumber('id');
		$groupsStructure->addText('name');
		$groupsStructure->addBool('verified');

		$groupsStructure = $dataStructure->getOrCreateTableStructure('parameters', 'id');
		$groupsStructure->addNumber('id');
		$groupsStructure->addNumber('method_id');
		$groupsStructure->addText('name');

		$userCompaniesStructure = $dataStructure->getOrCreateTableStructure('method_types', 'method_id');
		$userCompaniesStructure->addNumber('method_id');
		$userCompaniesStructure->addNumber('type_id');

		$dataStructure->addManyToMany('types', 'types', 'type_id', 'method_types', 'method_id', '{name} - {verified}');
		$dataStructure->addOneToMany('parameters', 'parameters', 'method_id', '{name}');

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

		$table->addColumn('returns', 'Returns');

		$table->addColumn('group', 'Group');

		$table->addColumn('types', 'Types');

		$table->addColumn('parameters', 'Parameters');

		$table->addColumn('description', 'Description');

		Assert::same(
			file_get_contents(__DIR__ . '/data/ListRendererTestOutput.html'),
			(string) $table->render(),
			'Output of table render doest not match'
		);
	}

}

$test = new ListRendererTest();
$test->run();
