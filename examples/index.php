<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<?php

define('SRC_DIR', __DIR__ . '/../src/');

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register('loadClasses', true, true);

function loadClasses($className)
{
	$filename = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

	if (!is_file(SRC_DIR . $filename)) {
		return false;
	}

	require_once SRC_DIR . $filename;

	return true;
}

@mkdir(__DIR__ . '/log');

\Tracy\Debugger::enable(\Tracy\Debugger::DEVELOPMENT, __DIR__ . '/log');


?>

<hr>

<div class="container">
	<h2>Basic functionality</h2>

	<hr>

	<?php

	$table = new \Mesour\UI\Table();

	$data = [
		[
			'method' => 'setName',
			'params' => '$name',
			'returns' => 'Mesour\Table\Column',
			'description' => 'Set column name.',
		],
		[
			'method' => 'setHeader',
			'params' => '$header',
			'returns' => 'Mesour\Table\Column',
			'description' => 'Set header text.',
		],
		[
			'method' => 'setCallback',
			'params' => '$callback',
			'returns' => 'Mesour\Table\Column',
			'description' => 'Set render callback.',
		],
	];

	$table->setSource($data);

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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>