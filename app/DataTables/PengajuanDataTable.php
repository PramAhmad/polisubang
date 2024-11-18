<?php

namespace App\DataTables;

use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengajuanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function($query) {
                $actionBtn = "<a href='/pengajuan/{$query->id}' class='btn btn-primary btn-sm'>
                <i class='fas fa-eye'></i>
                </a> ";
                $actionBtn .= "<a href='/pengajuan/{$query->id}/edit' class='btn btn-warning btn-sm'>
                <i class='fas fa-edit'></i>
                </a> ";
                $actionBtn .= "<form action='/pengajuan/{$query->id}/delete' method='post' class='d-inline'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <button type='submit' class='btn btn-danger btn-sm'>
                                <i class='fas fa-trash'></i>
                                </button>
                                </form>";
                return $actionBtn;

            })
            ->editColumn('id', function($query) {
                return "
                    <a href='" . route('pengajuan.download', ['id' => $query->id]) . "' class='btn btn-sm btn-danger'>
                        <i class='fa fa-download'></i> 
                    </a>
                ";
            })
            
            ->editColumn('user_id', function($query) {
                return $query->user->name;
            })
            ->editColumn('matakuliah_id', function($query) {
                return $query->matakuliah->name;
            })
            // carbon createed_at
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('d-m-Y');
            })
            ->addColumn('prasat', function($query) {
                return $query->prasat->pluck('nama_prasat')->implode('<br> ');
            })
            ->editColumn('status', function($query) {
                $status = $query->status;
                $badgeClass = match ($status) {
                    'pending' => 'badge bg-primary ',
                    'approved' => 'badge bg-success',
                    'reject' => 'badge bg-danger',
                    default => 'badge bg-secondary',
                };
                return "<span class='{$badgeClass}'>". ucfirst($status) ."</span>";
            })

            ->setRowId('id')
            ->rawColumns(['role','user_id','matakuliah_id','created_at','action','prasat','status','id']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pengajuan $model): QueryBuilder
    {
       if(auth()->user()->hasRole('superadmin') || auth()->user()->hasPermissionTo('approval pengajuan')){
            return $model->newQuery();
        }else{
            return $model->newQuery()->where('user_id', auth()->id());
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengajuan')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'language' => [
                            'processing' => '<div class="shadow p-3"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Processing...</div>'
                        ]
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            [
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => '#',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
                'width' => '5%',
                'class' => 'text-center',
            ],
            // pdf
            Column::make('id')->title('PDF'),
            Column::make('user_id')->title('User'),
            Column::make('matakuliah_id')->title('Matakuliah'),  
            Column::make('created_at')->title('Tanggal Pengajuan'),
            Column::make('prasat')->title('Prasat'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'pengajuan_' . date('YmdHis');
    }
}
