<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;         //Incluimos la referencia para poder utilizar Rule::
use Illuminate\Support\Facades\Storage; //Incluimos la referencia para poder utilizar Storage::
use Illuminate\Support\Facades\File;    //Incluimos la referencia para poder utilizar File::
use Illuminate\Http\Response;           //Incluimos la referencia para poder utilizar Response::

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        $user = \Auth::user();
        $id   = $user->id;

        //Validación del formulario
        $validate = $this->validate($request, [
            'name'     => ['required', 'string', 'max:255'],
            'surname'  => ['required', 'string', 'max:255'],
            //  Para poder actualizar un registro, si hemos indicado que el nick y el email han de ser únicos
            //y deseamos permitir mantener los mismos valores para dichos campos si son los valores de nuestro
            //registro debemos indicar que dicha regla se deberá ignorar en tal circunstancia:
            'nick'     => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id) ],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id) ]
        ]);

        //Recogida de datos del formulario
        $name    = $request->input('name');
        $surname = $request->input('surname');
        $nick    = $request->input('nick');
        $email   = $request->input('email');

        //Asignar nuevos valores al objeto de Usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Subimos la imagen al servidor
        $image_path = $request->file('image_path');
        if($image_path){            //Si se ha recibido correctamente la imagen
          //Generamos y asignamos un nombre único al fichero
            $image_path_name = time().$image_path->getClientOriginalName();
          //Guardar en la carpeta Storage: storage/app/users
            Storage::disk('users')->put($image_path_name,File::get($image_path));
          //Asignamos el nombre geneado al nombre del objeto
            $user->image = $image_path_name;
        }

        //Ejecutamos la consulta de actualización en la Base de Datos
        $user->update();

        //Redireccionamos a la página Config
        return redirect()->route('config')
                         ->with(['message'=>'Datos de usuario actualizados correctamente :)!']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
}
