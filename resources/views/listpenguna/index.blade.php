@extends('template.index')
@extends('template.datatablecss')
@extends('template.datatablesjs')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/sweetalert/package/dist/sweetalert2.css') }}">

        <h1>List Pengguna</h1>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>ID USER {{ $message }}</strong> Berhasil Dibuat
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @elseif($message = Session::get('delete'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>ID USER {{ $message }}</strong> Berhasil Dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @elseif($message = Session::get('diubah'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>ID USER {{ $message }}</strong> Berhasil Diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        
        <table class="display table table-striped" id="example">
            <thead>
                <tr>
                    <td>ID User</td>
                    <td>Password</td>
                    <td>Email</td>
                    <td>Deskripsi</td>
                    <td>Aksi</td>
                </tr>
            <thead>
                
                
            <tbody>
                @foreach ($penggunas as $penguna)
                <tr>
                    <td>{{ $penguna->login }}</td>
                    <td>{{ $penguna->pswd }}</td>
                    <td>{{ $penguna->email }}</td>
                    <td>{{ $penguna->deskripsi }}</td>
                    <td><a class="btn btn-warning" href="{{ URL::to('editpengguna',$penguna->login ) }}">Edit</a><button id="delete" onclick="deleteItem(this)" data-id="{{ $penguna->login }}" class="btn btn-danger" href="">Delete</button></td>
                </tr>    
                @endforeach
            </tbody>
        </table>

        
        <a href="{{ route('tambahpengguna') }}" class="btn btn-success">Tambah</a>
        <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
        <script src="{{ asset('assets/sweetalert/package/dist/sweetalert2.js') }}"></script>
<script>
    function deleteItem(e){

let id = e.getAttribute('data-id');
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});

swalWithBootstrapButtons.fire({
    title: 'Apakah ID User ' +id,
    text: "ingin di hapus?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    reverseButtons: true
}).then((result) => {
    if (result.value) {
        if (result.isConfirmed){
         window.location.href = `{{URL::to('delete/${id}')}}`
        }

    } else if (
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
        );
    }
});

}

</script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
          </script>
@endsection

  