<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Permiso;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
         $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::with('permisos')->where('email', $request->email)->whereDate('fechalimite','>=',date('Y-m-d'))->first();
        if ($user && $user->estado='ACTIVO') {
            if (Hash::check($request->password, $user->password)) {
                $user = User::with('permisos')->where('email', $request->email)->first();
                $token = $user->createToken('authToken')->plainTextToken;
                return response(['user' => $user, 'token' => $token]);
            } else {
                return response(['message' => 'Contraseña incorrecta'],500);
            }
        } else {
            return response(['message' => 'Usuario no encontrado'],500);
        }

    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['res' => 'salido exitosamente'], 200);
    }

    //CRUD
    public function index(){
        return User::
        with('permisos')->get();
    }

    public function userid($id){
        try{
       // return Persona::get();
         $personas= User::where('ci',$id)->get();
          return \response()->json($personas,200);
        }
        catch(\Exception $e){
         return \response()->json(['res'=> false, 'message'=>$e->getMessage()],200);
        }
     }

    public function listuser(){
        return User::
//            ->with('permisos')
            all();
    }
    public function store(Request $request){
        //        return ;
                $user=new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->fechalimite=$request->fechalimite;
                $user->password= Hash::make($request->password) ;
              //adicionado
                $user->apartment = $request->apartment;
                $user->cod_apartment = $request ->cod_apartment;
                $user->type = $request ->type;
                $user->save();
                $permisos= array();
                foreach ($request->permisos as $permiso){
        //            echo $permiso['estado'].'  ';
                    if ($permiso['estado']==true)
                        $permisos[]=$permiso['id'];
                }
                $permiso = Permiso::find($permisos);
                $user->permisos()->attach($permiso);
            }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return $user;
    }
    public function updatepermisos(Request $request, User $user){
        $permisos= array();
        foreach ($request->permisos as $permiso){
            if ($permiso['estado']==true)
                $permisos[]=$permiso['id'];
        }
        $permiso = Permiso::find($permisos);
        $user->permisos()->detach();
        $user->permisos()->attach($permiso);
    }
    public function pass(Request $request,  $id){
        $user=User::find($id);
        $user->password =Hash::make($request->password);
        $user->save();
        // $user->update([
        //     'password' => Hash::make($request->password)
        // ]);
        return $user;
    }
    public function destroy(User $user){
        $user->delete();
    }
    public function me(Request $request){
        $user=User::with('permisos')
        ->where('id',$request->user()->id)
        //->where('state','active')
        //->whereDate('fechaLimite','>=',date('Y-m-d'))
        ->firstOrFail();
    return $user;
    }
    public function userci($id){
        return User::where('ci',$id)->get();
    }
    public function cambioestado(Request $request){
        $user=User::find($request->id);
        if($user->status=='ACTIVO')
            $user->status='INACTIVO';
        else
            $user->status='ACTIVO';
        $user->save();

    }





}
