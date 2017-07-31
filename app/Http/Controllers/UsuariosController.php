<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cargo;
use App\Http\Requests\UsuariosRequest;
use App\Http\Requests\ModificarUsuarioRequest;
class UsuariosController extends Controller
{
    public function index()
    {
    	$usuarios = User::join('cargos','users.cargo','=', 'cargos.idcargo')->paginate(5);
    	return view('usuarios.index')->with('usuarios', $usuarios);
    }

    public function registro()
    {
    	$cargos = Cargo::where('idcargo' , '!=', 1)->get();
    	return view('usuarios.registro')->with('cargos',$cargos);
    }

    public function save(UsuariosRequest $request)
    {
    	User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'cargo' => $request['cargo'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect('usuarios');
    }

    public function buscar($id)
    {
        $usuario = User::find($id);
        return view('usuarios.modificar')->with('usuario',$usuario);
    }

    public function update(ModificarUsuarioRequest $request)
    {
        $id = $request['id'];
        $usuario = User::find($id);
        $usuario->name = $request['name'];
        $usuario->username = $request['username'];
        $usuario->save();

        
        return redirect('usuarios');
    }

    public function borrar($id)
    {
        $usuario = User::find($id);
        return view('usuarios.borrar')->with('usuario',$usuario);
        

        return redirect('usuarios');
    }
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $usuario = User::find($id);

        $usuario->avatar = "hola.jpg";
        $usuario->save();
        return redirect('usuarios');
    }
}
