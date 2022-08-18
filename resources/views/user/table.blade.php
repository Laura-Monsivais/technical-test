@extends('home')

@section('table')
    <div class="container">
        <h1>Usuarios</h1>
        <table class="table table-bordered data-table" id="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.table') }}",
                dom: 'Bfrtip',
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
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    "targets": [3],
                    "render": function(data, type, row, meta) {
                        return '<button class="btn btn-primary btn-update" data-id="' + data +
                            '">Actualizar</button>';
                    }
                }]

            });

        });

        $(document).on('click', ".data-table tbody a button", function() {
            $("#modaldata tbody a").html("");
            $("#modaldata tbody a").html($(this).closest("a").html());
            $("#modaldata tbody a").modal("show");
        });

        $('.data-table tbody').on('click', 'button', function() {
            var data = $(this).data('id');
            $("#modaldata tbody a").html("");
            $("#modaldata tbody a").html($(this).closest("a").html());
            $("#modaldata tbody a").modal("show");
        });
    </script>
@endsection
