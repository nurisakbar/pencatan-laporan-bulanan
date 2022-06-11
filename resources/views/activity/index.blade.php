@extends('layouts.app')
@section('title','Uraian Kegiatan')
@section('content')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Uraian Kegiatan Periode {{ date('M Y') }}</div>

                <div class="card-body">
                    @include('alert')
                    <a href="/activity/create" class="btn btn-danger btn-sm">Add New Activity</a>
                    <hr>
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Tanggal</th>
                                <th>Uraian Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Jumlah Jam</th>
                                <th>Keterangan</th>
                                <th width="70">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/activity',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'date', name: 'date' },
                { data: 'activity', name: 'activity' },
                { data: 'location', name: 'location' },
                { data: 'number_of_hour', name: 'number_of_hour' },
                { data: 'note', name: 'note' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush


