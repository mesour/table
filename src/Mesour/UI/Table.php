<?php
/**
 * Mesour Table Component
 *
 * @license LGPL-3.0 and BSD-3-Clause
 * @copyright (c) 2015 Matous Nemec <matous.nemec@mesour.com>
 */

namespace Mesour\UI;

use Mesour\Components\Helper;
use Mesour\Components\IContainer;
use Mesour\Table\BaseTable;
use Mesour\Table\Column;
use Mesour\Table\Render\IColumn;

/**
 * @author mesour <matous.nemec@mesour.com>
 * @package Mesour Table Component
 */
class Table extends BaseTable
{

    public $onRender = [];

    public $onRenderHeader = [];

    public $onRenderBody = [];

    /**
     * @var array
     */
    protected $attributes = [
        'class' => 'table'
    ];

    public function __construct($name = NULL, IContainer $parent = NULL)
    {
        parent::__construct($name, $parent);
        $this->addComponent(new Control, 'col');
    }

    public function setAttributes(array $attributes = [])
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setAttribute($key, $value, $append = FALSE)
    {
        Helper::createAttribute($this->attributes, $key, $value, $append);
        return $this;
    }

    /**
     * @param $name
     * @param null $header
     * @return Column
     */
    public function addColumn($name, $header = NULL)
    {
        return $this->setColumn(new Column, $name, $header);
    }

    protected function setColumn(IColumn $column, $name, $header = NULL)
    {
        $column->setHeader($header);
        return $this['col'][$name] = $column;
    }

    /**
     * @return IContainer[]
     */
    public function getColumns()
    {
        return $this['col'];
    }

    /**
     * @return \Mesour\Table\Render\Renderer|\Mesour\Table\Render\Table\Renderer
     * @throws \Mesour\Components\Exception
     */
    public function create()
    {
        parent::create();

        $renderer = $this->getRendererFactory();

        $data = $this->getSource()->fetchAll();

        $this->onRender($this, $data);

        $table = $renderer->createTable();

        $table->setAttributes($this->attributes);

        $header = $renderer->createHeader();

        foreach ($this->getColumns() as $column) {
            $headerCell = $renderer->createHeaderCell($column);
            $header->addCell($headerCell);
        }
        $this->onRenderHeader($header, $data);

        $table->setHeader($header);

        $body = $renderer->createBody();

        foreach ($data as $item) {
            $row = $renderer->createRow($item);
            foreach ($this->getColumns() as $column) {
                $cell = $renderer->createCell($item, $column);
                $row->addCell($cell);
            }
            $body->addRow($row);
        }

        $this->onRenderBody($body, $data);

        $table->setBody($body);

        return $table;
    }

    public function render()
    {
        if ($this->getSession()) {
            $this->getSession()->saveState();
        }
        echo $this->create()->create();
    }

}
