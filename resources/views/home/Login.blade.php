<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/"> --}}

    

    <!-- Bootstrap core CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/sweetalert/package/dist/sweetalert2.css') }}">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #button {
  background-color: #f9fbfc;
  width: 100%;
  padding: 5px 0 10px 0;
}

    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  {{-- {{ $errors->first('msg') }} --}}
  <form action="{{ url('/home') }}" method="POST">
    {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
    <h1 class="h3 mb-3 fw-normal">Login System</h1>
@csrf
    <div class="form-floating">
      <input type="text" class="form-control {{ $errors->first('login')? "is-invalid" : "" }}" id="login" value="{{ old('login') }}" name="login" placeholder="Login Id">
      <label for="floatingInput">ID User</label>
      <div class="invalid-feedback">
        {{ $errors->first('login')}}
      </div>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control  {{ $errors->first('password')? "is-invalid" : "" }}" id="password" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
      <div class="invalid-feedback">
        {{ $errors->first('password')}}
      </div>
    </div>


    <div id="button">
        <button type="submit" class="button_airpump btn btn-primary">Login</button>
        <a class="button_airpump btn btn-danger" href="{{ route('list') }}">Batal</a>
      </div>
    {{-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> --}}
  </form>
</main>



<script src="{{ asset('assets/sweetalert/package/dist/sweetalert2.js') }}"></script>
@if ($errors->first('msg'))
<script>
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: "{{ $errors->first('msg') }}",
  text: "",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    
  }
})
</script>
@endif
  </body>
</html>