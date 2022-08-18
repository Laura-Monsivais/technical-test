@extends('layout')

@section('title', 'Usuarios')

@section('content')
<nav class="navbar navbar-light bg-dark justify-content-between">
    <a href="/dashboard" class="navbar-brand" style="color: rgb(243, 243, 243)"><h4>PRUEBA TÉCNICA</h4></a>
    <form class="form-inline">
      <button class="btn btn-outline-light my-2 my-sm-0" id="btn_logout">Cerrar Sesión</button>
    </form>
  </nav>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center; color:brown">Dashboard</h1>
                <div class="card">
                    @yield('table')
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function logout() {
            $.ajax({
                method: 'POST',
                url: 'api/logout',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.href = "/";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error' + jqXHR.responseText)
                }
            });
        }


        var button = document.getElementById("btn_logout");
        button.addEventListener("click", logout);
    </script>
@endsection
