<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $validation = $this->validateService(Validator::make($request->all(), User::$rules));
        if (sizeof($validation) == 0) {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'error'     => true,
                    'message'   => 'Las credenciales son incorrectas.',
                    'data'      => '',
                ], 404);
            }
            return response()->json([
                'error'     => false,
                'message'   => 'Iniciaste sesión correctamente.',
                'data'     => 'true'
            ], 200);
        } else {
            return response()->json([
                'error'     => true,
                'message'   => $validation,
                'data'      => ''
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    }



    public function Register(Request $request)
    {
        $rules = [
            'name'             => 'required|max:100|min:3',
            'email'            => 'required|email|unique:users',
            'password'         => 'required',
            'confirm_password' => 'required|same:password',
            'phone'            => 'required|min:10',
            'person'            => 'required',
            'rfc'              => 'required|min:12|max:13',
        ];
        $rfc = strlen($request->rfc);

        if ($request->person === 'Moral' && $rfc == 13) {

            return response()->json([
                'error'     => true,
                'message'   => 'El RFC para persona Moral es de 12 caracteres',
                'data'      => '',
            ], 404);
        }
        if ($request->person === 'Fisica' && $rfc == 12) {
            return response()->json([
                'error'     => true,
                'message'   => 'El RFC para persona Fisica es de 13 caracteres',
                'data'      => '',
            ], 404);
        }
        $validation = $this->validateService(Validator::make($request->all(), $rules));
        if (sizeof($validation) == 0) {
            $input                      = $request->all();
            $input['password']          = bcrypt($input['password']);
            $input['confirm_password']  = bcrypt($input['confirm_password']);
            $user                       = User::create($input);
            return response()->json([
                'error'     => false,
                'message'   => 'Registro creado correctamente.',
                'data'      => ''
            ], 200);
        } else {
            return response()->json([
                'error'     => true,
                'message'   => [$validation],
                'data'      => '',
            ], 404);
        }
    }

    function validateService($validator)
    {
        if ($validator->passes()) {
            $validation = $validator->validated();
        }
        $validation = $validator->errors()->all();
        return $validation;
    }

}
