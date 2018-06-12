<?php

namespace App\DataTables;

use App\Menu;
use Yajra\DataTables\Services\DataTable;

class MenusDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('action', function ($menu) {
            return '<a href="menus/'.$menu->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
    {
        return $model->newQuery()->select('id', 'text', 'label', 'url', 'can', 'icon', 'parent_id',
        'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'text',
            'label',
            'url',
            'can',
            'icon',
            'parent_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Menus_' . date('YmdHis');
    }

    protected function getBuilderParameters()
    {
      return [
        'dom'          => 'Bfrtip',
        'buttons'      => ['create', 'reset', 'reload'],
        'pageLength'   => 10,
      ];
    }
}
