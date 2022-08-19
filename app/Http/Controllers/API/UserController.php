<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function update(Request $request)
    {
       
        $rules = [
            'name'             => 'required|max:100|min:3',
           // 'email'            => 'required|max:70|distinct|unique:users,email,' . $id . ',id',
            'phone'            => 'required|min:10',
            'person'           => 'required',
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
            $user = User::find($request->id);
            if ($user != NULL) {
                $user->name             = $request->name;
                $user->email            = $request->email;
                $user->phone            = $request->phone;
                $user->person           = $request->person;
                $user->rfc              = $request->rfc;
                $user->save();

                return response()->json([
                    'error'     => false,
                    'message'   => 'Usuario actualizado correctamente',
                    'data'      => $user
                ], 200);
            } else {
                return response()->json([
                    'error'     => true,
                    'message'   => 'El usuario no existe',
                    'data'      => '',
                ], 404);
            }
        } else {
            return response()->json([
                'error'     => true,
                'message'   => [$validation],
                'data'      => '',
            ], 404);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user == NULL) {
            return response()->json([
                'error'     => true,
                'message'   => 'El usuario no existe',
                'data'      => ''
            ], 404);
        } else {
            return response()->json([
                'error'     => false,
                'message'   => '',
                'data'      => $user
            ], 200);
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
