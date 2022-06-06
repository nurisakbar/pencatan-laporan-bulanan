<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal</label>
      {!! Form::date('date', null, ['class'=>'form-control','placeholder'=>'Tanggal']) !!}
  </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="exampleInputEmail1">Lokasi</label>
      {!! Form::text('location', null, ['class'=>'form-control','placeholder'=>'Lokasi Kerja']) !!}
  </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Jam</label>
      {!! Form::text('number_of_hour', null, ['class'=>'form-control','placeholder'=>'Jumlah Jam']) !!}
  </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Aktifitas</label>
      {!! Form::textarea('activity', null, ['class'=>'form-control','id'=>'editor','colspan'=>50,'rowspan'=>400,'placeholder'=>'Deskripsi Kegiatan Yang Anda Kerjakan']) !!}
    </div>
  </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label for="exampleInputEmail1">Bukti Pendukung</label>
      {!! Form::file('file', null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="/activity" class="btn btn-primary">Kembali</a>
    </div>
  </div>
</div>







  @push('scripts')
<!-- DataTables -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<script>
  ClassicEditor
      .create( document.querySelector( '#editor' ), {
      minHeight: '300px'
    } )
      .catch( error => {
          console.error( error );
      } );
</script>
@endpush