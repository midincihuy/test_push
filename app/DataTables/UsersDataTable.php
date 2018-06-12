<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            // ->addColumn('action', 'usersdatatable.action');
            ->addColumn('roles', function ($user) {
              $data = $user->roles->pluck('name');
              $x = array();
              foreach ($data as $key => $value) {
                $x[] = $value;
              }
              return implode(',',$x);
          })
          ->addColumn('action', function ($user) {
              return '<a href="users/'.$user->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
          });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'name', 'email', 'created_at', 'updated_at');
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
          'name',
          'email',
          'roles',
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
        return 'Users_' . date('YmdHis');
    }
    protected function getBuilderParameters()
    {
      return [
        'dom'          => 'Bfrtip',
        'buttons'      => ['create', 'excel', 'reset', 'reload'],
        'pageLength'   => 10,
      ];
    }
}
