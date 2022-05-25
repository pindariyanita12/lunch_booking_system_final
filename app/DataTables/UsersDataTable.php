<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
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

        return datatables()
            ->eloquent($query)
            ->editColumn('userempid', function ($userdata) {

                return empty($userdata->user->emp_id) ? "NA" : $userdata->user->emp_id;
            })
            ->editColumn('username', function ($userdata) {
                return empty($userdata->user->name) ? "NA" : $userdata->user->name;
            })
            ->editColumn('uniquerecord', function ($userdata) {
                return $userdata->uniquerecord;
            })
            ->addColumn('action', function ($userdata)  {
                $actionBtn = '<a href="' . route('admin.admindashboard.destroy', [$userdata->id, ]) . '" class="btn btn-danger btn-sm" ><i class="fa fa-trash ">Delete</i></a>';
                return $actionBtn;
            })->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = DB::table('records')->join('users', 'users.id', '=', 'records.user_id')->whereYear('records.created_at', '=', date('Y'))->whereMonth('records.created_at', '=', date('m'))->select(DB::raw('DISTINCT users.id,users.emp_id,users.email, users.name,COUNT(is_taken) AS uniquerecord'))->groupBy('users.email')->get();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('emp_id'),
            Column::make('name'),
            Column::make('total'),
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
}
