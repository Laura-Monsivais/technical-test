@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center">Dashboard</h1>
                <button id="btn_logout">Cerrar Sesión</button>
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
