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
		->setCallback(function ($rawData, \Mesour\Table\Column $column) {
			return \Mesour\Components\Utils\Html::el('b')->setText($rawData['method']);
		});

	$table->addColumn('params', 'Parameters');

	$table->addColumn('returns', 'Returns');

	$table->addColumn('description', 'Description');

	echo $table->render();

	?>
</div>

<hr>