@extends('home')

@section('table')
    <div class="container">
        <h1>Usuarios</h1>
        <table class="table table-bordered data-table" id="data-table" style="width: 100px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Correo eléctronico</th>
                    <th>Teléfono</th>
                    <th>Tipo de persona</th>
                    <th>RFC</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <!--Modal para CRUD-->
        <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUsers">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Correo eléctronico:</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Teléfono:</label>
                                <input type="number" class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Tipo de persona:</label>
                                <select class="form-select" aria-label="Default select example" id="person">
                                    <option value="Moral">Moral</option>
                                    <option value="Fisica">Fisica</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="rfc" class="col-form-label">RFC:</label>
                                <input type="text" class="form-control" id="rfc">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-dark">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function() {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('user.table') }}",
                    dom: 'Bfrtip',
                    responsive: true,
                    buttons: [
                        'csv', 'pdf'
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'person',
                            name: 'person'
                        },
                        {
                            data: 'rfc',
                            name: 'rfc'
                        },
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    columnDefs: [{
                        "targets": [6],
                        "render": function(data, type, row, meta) {
                            return '<button class="btn btn-warning btn-update" data-id="' + data +
                                '">Actualizar</button>';
                        }
                    }]

                });

            });

            $('.data-table tbody').on('click', 'button', function() {
                var data = $(this).data('id');
                fila = $(this).closest("tr");
                id = parseInt(fila.find('td:eq(0)').text());
                name = fila.find('td:eq(1)').text();
                email = fila.find('td:eq(2)').text();
                phone = fila.find('td:eq(3)').text();
                person = fila.find('td:eq(4)').text();
                rfc = fila.find('td:eq(5)').text();

                $("#name").val(name);
                $("#email").val(email);
                $("#phone").val(phone);
                $("#person").val(person);
                $("#rfc").val(rfc);

                $(".modal-header").css("background-color", "#ffc107");
                $(".modal-header").css("color", "white");
                $(".modal-title").text("Actualizar usuario");
                $("#modalUpdate").modal("show");

            });

            var formUsers = document.getElementById('formUsers');
            formUsers.addEventListener('submit', function(e) {
                e.preventDefault();
                var table = $('#data-table').DataTable();
                id = parseInt(fila.find('td:eq(0)').text());
                $.ajax({
                    method: 'POST',
                    url: 'api/updateUsers',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                        name: $("#name").val(),
                        email: $("#email").val(),
                        phone: $("#phone").val(),
                        person: $("#person").val(),
                        rfc: $("#rfc").val(),
                    },
                    success: function(data) {
                        alert(data.message)
                        $("#modalUpdate").modal("hide");
                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        alert('Error: ' + jqXHR.responseJSON.message)
                    }
                });

            })
        </script>
    @endsection
