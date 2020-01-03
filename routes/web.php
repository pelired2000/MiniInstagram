<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Añadimos la referencia para poder hacer uso de la clase Image y sus métodos
use App\Image;

Route::get('/', function () {

    $images = Image::all(); //Obtenemos todas las imágenes registradas
    foreach($images as $image){
        echo $image->image_path  . "<br/>";
        echo $image->description . "<br/>";

      //Mostramos el Nombre y Apellidos del usuario que subió la imagen
        echo $image->user->name . ' ' . $image->user->surname . "<br/>";
      //Mostrarmos los comentarios asociados a la imagen si los hubiera
      if(count($image->comments) >= 1){
        echo '<h4>Comentarios</h4>';
        foreach($image->comments as $comment){
            //Mostramos el Nombre y Apellidos del usuario que comentó la imagen
            echo $comment->user->name . ' ' . $comment->user->surname . ": ";
            echo $comment->content . '<br/>';
        }
      }
      //Mostrarmos los comentarios asociados a la imagen
      echo 'Likes:' . count($image->likes);

      echo "<hr/>";
    }
    die();
    return view('welcome');
});


Auth::routes();

Route::get('/','HomeController@index')->name('home');
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
