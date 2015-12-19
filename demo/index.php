<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../docs/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="../docs/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="../docs/js/jquery.min.js"></script>
<script src="../docs/js/bootstrap.min.js"></script>
<script src="../docs/js/main.js"></script>

<?php

define('SRC_DIR', __DIR__ . '/../src/');

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register('loadClasses', true, true);

function loadClasses($className)
{
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (!is_file(SRC_DIR . $filename)) {
        return FALSE;
    }

    require_once SRC_DIR . $filename;

    return TRUE;
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

    $data = array(
        array(
            'method' => 'setName',
            'params' => '$name',
            'returns' => 'Mesour\Table\Column',
            'description' => 'Set column name.',
        ),
        array(
            'method' => 'setHeader',
            'params' => '$header',
            'returns' => 'Mesour\Table\Column',
            'description' => 'Set header text.',
        ),
        array(
            'method' => 'setCallback',
            'params' => '$callback',
            'returns' => 'Mesour\Table\Column',
            'description' => 'Set render callback.',
        )
    );

    $table->setSource($data);

    $table->setAttribute('class', 'table table-striped table-hover');

    $table->addColumn('method', 'Method')
        ->setCallback(function($rawData, \Mesour\Table\Column $column) {
            return \Mesour\Components\Utils\Html::el('b')->setText($rawData['method']);
        });

    $table->addColumn('params', 'Parameters');

    $table->addColumn('returns', 'Returns');

    $table->addColumn('description', 'Description');

    $table->render();

    ?>
</div>

<hr>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>