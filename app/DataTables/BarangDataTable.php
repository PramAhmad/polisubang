<?php

namespace App\DataTables;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BarangDataTable extends DataTable
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
                return view('datatable-actions.barang', compact('query'));
            })
            ->editColumn('is_expired', function($query) {
                if (is_null($query->tanggal_expired)) {
                    return '<span class="badge bg-secondary">Tidak Expired</span>';
                } elseif ($query->tanggal_expired < now()) {
                    return '<span class="badge bg-primary">Ya</span>';
                } else {
                    return '<span class="badge bg-warning">Tidak</span>';
                }
            })
            
            ->editColumn('type', function($query) {
                // alat / bahan
                return $query->type == 'alat' ? '<span class="badge bg-primary ">Alat</span>' : '<span class="badge bg-info ">Bahan</span>';

            })
            ->editColumn('tanggal_expired', function($query) {
                // carbon tanngal expired
                return $query->tanggal_expired 
                ? \Carbon\Carbon::parse($query->tanggal_expired)->translatedFormat('j F Y') 
                : '-';
        
            })
            ->setRowId('id')
            ->rawColumns(['role', 'expired','type','is_expired']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Barang $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('barang-table')
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
            
            Column::make('nama_barang'),
            Column::make('type'),

            Column::computed('is_expired'),
            Column::make('jumlah'),
            Column::make('tanggal_expired'),
            Column::make('kondisi'),
            Column::make('lokasi_barang'),
            Column::computed('action')
                  ->exportable(true)
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
        return 'Barang_' . date('YmdHis');
    }
}
