@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <nav class="navbar navbar-light bg-dark justify-content-between">
        <a href="/dashboard" class="navbar-brand" style="color: rgb(243, 243, 243)">
            <h4>PRUEBA TÉCNICA</h4>
        </a>
        <form class="form-inline">
            <button class="btn btn-outline-light my-2 my-sm-0" id="btn_logout">Cerrar Sesión</button>
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center; color:brown">Dashboard</h1>
                <div class="col-md-12">
                    Bienvenido: <input id="nametxt" style="border: 0;" disabled>
                </div>
                <div class="col-md-6">
                    Correo eléctronico: <input id="emailtxt" style="border: 0;" disabled>
                </div>
                <div class="card">
                    @yield('table')
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        var nametxt = document.getElementById('nametxt');
        var emailtxt = document.getElementById('emailtxt');
        var button = document.getElementById("btn_logout");
        button.addEventListener("click", logout);
        var myApp = (function() {
            var current;
            return {
                current: currentuser()
            }
        })();

        function currentuser() {
            $.ajax({
                method: 'GET',
                url: 'api/current-user',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    nametxt.value = data[0].name;
                    emailtxt.value = data[0].email;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error' + jqXHR.responseText)
                }
            });
        }

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
    </script>
@endsection
