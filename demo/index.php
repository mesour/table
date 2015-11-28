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

@mkdir(__DIR__ . '/log');

\Tracy\Debugger::enable(\Tracy\Debugger::DEVELOPMENT, __DIR__ . '/log');

require_once SRC_DIR . 'Mesour/Table/ITable.php';
require_once SRC_DIR . 'Mesour/Table/BaseTable.php';
require_once SRC_DIR . 'Mesour/UI/Table.php';

require_once SRC_DIR . 'Mesour/Table/Render/Attributes.php';
require_once SRC_DIR . 'Mesour/Table/Render/Body.php';
require_once SRC_DIR . 'Mesour/Table/Render/Cell.php';
require_once SRC_DIR . 'Mesour/Table/Render/Header.php';
require_once SRC_DIR . 'Mesour/Table/Render/HeaderCell.php';
require_once SRC_DIR . 'Mesour/Table/Render/IColumn.php';
require_once SRC_DIR . 'Mesour/Table/BaseColumn.php';
require_once SRC_DIR . 'Mesour/Table/Column.php';
require_once SRC_DIR . 'Mesour/Table/Render/IRendererFactory.php';
require_once SRC_DIR . 'Mesour/Table/Render/Renderer.php';
require_once SRC_DIR . 'Mesour/Table/Render/Row.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/Row.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/Renderer.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/Body.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/Cell.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/Header.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/HeaderCell.php';
require_once SRC_DIR . 'Mesour/Table/Render/Table/RendererFactory.php';

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
        ->setCallback(function($data) {
            return \Mesour\Components\Html::el('b')->setText($data['method']);
        });

    $table->addColumn('params', 'Parameters');

    $table->addColumn('returns', 'Returns');

    $table->addColumn('description', 'Description');

    $table->render();

    ?>
</div>

<hr>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>