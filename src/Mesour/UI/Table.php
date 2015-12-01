<?php
/**
 * This file is part of the Mesour Table (http://components.mesour.com/component/table)
 *
 * Copyright (c) 2015 Matouš Němec (http://mesour.com)
 *
 * For full licence and copyright please view the file licence.md in root of this project
 */

namespace Mesour\UI;

use Mesour\Components\Helper;
use Mesour\Components\IContainer;
use Mesour\Table\BaseTable;
use Mesour\Table\Column;
use Mesour\Table\Render\IColumn;
use Mesour\Table\Render\Table\Body;
use Mesour\Table\Render\Table\Header;



/**
 * @author Matouš Němec <matous.nemec@mesour.com>
 *
 * @method null onRenderHeader(Header $header, $rawData, $data)
 * @method null onRender(Table $table, $rawData, $data)
 * @method null onRenderBody(Body $body, $rawData, $data)
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
        $rawData = $this->getSource()->fetchLastRawRows();

        $this->onRender($this, $rawData, $data);

        $table = $renderer->createTable();

        $table->setAttributes($this->attributes);

        $header = $renderer->createHeader();

        foreach ($this->getColumns() as $column) {
            /** @var IColumn $column */
            $headerCell = $renderer->createHeaderCell($column);
            $header->addCell($headerCell);
        }
        $this->onRenderHeader($header, $rawData, $data);

        $table->setHeader($header);

        $body = $renderer->createBody();

        foreach ($data as $key => $item) {
            $row = $renderer->createRow($item, $rawData[$key]);
            foreach ($this->getColumns() as $column) {
                $cell = $renderer->createCell($item, $column, $rawData[$key]);
                $row->addCell($cell);
            }
            $body->addRow($row);
        }

        $this->onRenderBody($body, $rawData, $data);

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
