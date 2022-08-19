@extends('auth.layout')

@section('title', 'Registro')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registro</div>

                    <div class="card-body">
                        <form id="formUpdate">
                            @csrf

                            <div class="form-group row">
                                <label for="text" class="col-sm-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="name"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Correo
                                    eléctronico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirmar
                                    contraseña</label>

                                <div class="col-md-6">
                                    <input id="confirm_password" type="password"
                                        class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                        name="confirm_password" required>

                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone"
                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                        min="10" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" id="person">
                                    <option selected>Tipo de persona</option>
                                    <option value="Moral">Moral</option>
                                    <option value="Fisica">Fisica</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rfc" class="col-md-4 col-form-label text-md-right">RFC</label>

                                <div class="col-md-6">
                                    <input id="rfc" type="rfc"
                                        class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc"
                                       required>

                                    @if ($errors->has('rfc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rfc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="/" type="submit" class="btn btn-secondary">
                                        Regresar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var formUpdate = document.getElementById('formUpdate');
        formUpdate.addEventListener('submit', function(e) {
            $.ajax({
                method: 'PUT',
                url: 'api/register/create',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    confirm_password: $("#confirm_password").val(),
                    phone: $("#phone").val(),
                    person: $("#person").val(),
                    rfc: $("#rfc").val(),
                },
                success: function(data) {
                    alert(data.message)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + jqXHR.responseJSON.message)
                }
            });

        })
    </script>
@endsection
