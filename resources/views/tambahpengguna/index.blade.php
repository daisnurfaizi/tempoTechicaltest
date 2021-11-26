@extends('template.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/sweetalert/package/dist/sweetalert2.css') }}">
<h1>{{ $judul }}</h1>
<form  action="{{ url('save') }}" id="tambahpengguna" method="POST">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">ID User</label>
    <input type="text" name="login" class="form-control {{ $errors->first('login')? "is-invalid" : "" }}" id="login" value="{{ old('login') }}" aria-describedby="emailHelp" placeholder="Tulis Id Anda">
    <div class="invalid-feedback">
      {{ $errors->first('login')}}
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pswd" class="form-control " id="password" placeholder="Password" required>
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control {{ $errors->first('email')? "is-invalid" : "" }}" id="email" value="{{ old('email') }}" name="email" aria-describedby="emailHelp" placeholder="Isi Email Anda">
    <div class="invalid-feedback">
      {{ $errors->first('email')}}
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi"  class="form-control {{ $errors->first('deskripsi')? "is-invalid" : "" }}"  placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>
    {{-- <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"> --}}
    <div class="invalid-feedback">
      {{ $errors->first('deskripsi')}}
    </div>
  </div>
 <div class="mt-10">
  <button type="submit" class="btn btn-primary">Simpan</button>
  <button type="submit" id="batal" class="btn btn-danger">Batal</button>
  </div>
</form>
<script src="{{ asset('assets/sweetalert/package/dist/sweetalert2.js') }}"></script>
<script>
  var batal = document.getElementById("batal")
  var from = document.getElementById("tambahpengguna")
  batal.addEventListener("click", function(e){
  e.preventDefault()
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Peringatan?',
  text: "Apakah Proses Tambah Pengguna Akan di batalkan!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Berhasil!',
      'Datapenguna di batalkan.',
      'success'
    )
    from.reset()
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
}); 
</script>
@endsection
