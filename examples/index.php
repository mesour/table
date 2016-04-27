<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
      integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<?php

define('SRC_DIR', __DIR__ . '/../src/');

require_once __DIR__ . '/../vendor/autoload.php';

@mkdir(__DIR__ . '/log');
@mkdir(__DIR__ . '/tmp');

\Tracy\Debugger::enable(\Tracy\Debugger::DEVELOPMENT, __DIR__ . '/log');

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(SRC_DIR);
$loader->setCacheStorage(new Nette\Caching\Storages\FileStorage(__DIR__ . '/tmp'));
$loader->register();

?>

<hr>

<div class="container">
	<h2>Basic functionality</h2>

	<hr>

	<?php

	$table = new \Mesour\UI\Table();

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

	echo $table->render();

	?>
</div>

<hr>