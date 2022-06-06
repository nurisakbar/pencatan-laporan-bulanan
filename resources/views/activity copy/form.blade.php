

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Toko</label>
      {!! Form::text('nama_toko', null, ['class'=>'form-control','placeholder'=>'Nama Toko']) !!}
  </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Kategori Toko</label>
      {!! Form::text('kategori_toko', null, ['class'=>'form-control','placeholder'=>'Kategori Toko']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor HP</label>
      {!! Form::text('nomor_hp', null, ['class'=>'form-control','placeholder'=>'Nomor HP']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Kartu Perdana</label>
      {!! Form::select('kartu_perdana',['Kartu Ada Dan Aktif'=>'Kartu Ada Dan Aktif','Tidak Aktif Dan Ada'=>'Tidak Aktif Dan Ada','Hilang'=>'Hilang'], null, ['class'=>'form-control','placeholder'=>'-- Pilih Data --']) !!}
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor Rekening</label>
      {!! Form::text('nomor_rekening', null, ['class'=>'form-control','placeholder'=>'Nomor Rekening']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Bank</label>
      {!! Form::text('nama_bank', null, ['class'=>'form-control','placeholder'=>'Nama Bank']) !!}
    </div>
  </div>
  <div class="col-md-3">
    <label for="exampleInputEmail1">Pemilik Rekening</label>
    {!! Form::text('pemilik_rekening', null, ['class'=>'form-control','placeholder'=>'Pemilik Rekening']) !!}
  </div>
  <div class="col-md-3">
    <label for="exampleInputEmail1">Merchant ID</label>
    {!! Form::text('merchant_id', null, ['class'=>'form-control','placeholder'=>'Merchant ID']) !!}
  </div>


  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Saldo Tersedia</label>
      {!! Form::text('saldo_tersedia', null, ['class'=>'form-control money','placeholder'=>'Saldo tersedia']) !!}
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Dana Diproses</label>
      {!! Form::text('dana_diproses', null, ['class'=>'form-control money','placeholder'=>'Dana Diproses']) !!}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Product</label>
      {!! Form::text('jumlah_product', null, ['class'=>'form-control','placeholder'=>'jumlah product']) !!}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Update</label>
      {!! Form::date('tanggal_update', null, ['class'=>'form-control','placeholder'=>'Tanggal Update']) !!}
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label for="exampleInputEmail1">Limit Product</label>
      {!! Form::select('limit_product',[1=>'Limit',0=>'Tidak'], null, ['class'=>'form-control']) !!}
    </div>
  </div>
</div>

  <button type="submit" class="btn btn-primary">Simpan Toko</button>
  <a href="/toko" class="btn btn-primary">Kembali</a>



  @push('scripts')
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('js/simple.money.format.js')}}"></script>
<script type="text/javascript">
  $('.money').simpleMoneyFormat();
</script>
@endpush