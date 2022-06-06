@extends('layouts.app')
@section('title','Kelola Data Toko')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kelola Data Toko</h6>
    </div>
    <div class="card-body">
        @include('alert')
        @if (!in_array(Auth::user()->level,['administrator','akuntan']))
            <a href="/toko/create" class="btn btn-danger">Tambah Data Toko</a>
            <hr>
        @endif
        <div class="table-responsive">
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Toko</th>
                    <th>Email</th>
                    <th>Kategori Toko</th>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Pemilik Rekening</th>
                    <th>Nomor HP</th>
                    <th>Kartu Perdana</th>
                    <th>Merchant ID</th>
                    <th>Saldo Tersedia</th>
                    <th>Dana Diproses</th>
                    <th>Jumlah Product</th>
                    <th>Limit Product</th>
                    <th>Tanggal Update</th>
                    <th width="70">#</th>
                </tr>
            </thead>
        </table>
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
            ajax: '/toko',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'nama_pegawai', name: 'nama_pegawai' },
                { data: 'nama_toko', name: 'nama_toko' },
                { data: 'email', name: 'email' },
                { data: 'kategori_toko', name: 'kategori_toko' },
                { data: 'nama_bank', name: 'nama_bank' },
                { data: 'nomor_rekening', name: 'nomor_rekening' },
                { data: 'pemilik_rekening', name: 'pemilik_rekening' },
                { data: 'nomor_hp', name: 'nomor_hp' },
                { data: 'kartu_perdana', name: 'kartu_perdana' },
                { data: 'merchant_id', name: 'merchant_id' },
                { data: 'saldo_tersedia', name: 'saldo_tersedia' },
                { data: 'dana_diproses', name: 'dana_diproses' },
                { data: 'jumlah_product', name: 'jumlah_product' },
                { data: 'limit_product', name: 'limit_product' },
                { data: 'tanggal_update', name: 'tanggal_update' },
                { data: 'action', name: 'action' }
            ]
        });
    });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush


