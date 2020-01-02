<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $table = 'images';  //Indicamos la tabla que va a modificar este modelo

    // Definimos una relación OneToMany (uno a muchos) entre Imágenes y Comentarios
    // Permite recuperar un array de objetos con todos los comentarios asociados a una Imagen
    public function comments(){
       return $this->hasMany('App\Comment');  //Modelo con el que relacionamos el modelo Imagen
    }

    // Definimos una relación OneToMany (uno a muchos) entre Imágenes y Likes
    // Permite recuperar un array de objetos con todos los Likes asociados a una Imagen
    public function likes(){
      return $this->hasMany('App\Like');  //Modelo con el que relacionamos el modelo Imagen
    }

    // Definimos una relación ManyToOne (muchos a uno) entre Imágenes y Usuario
    // Permite recuperar el usuario que subió una Imagen
    public function user(){
        return $this->belongsTo('App\User','user_id');  //Modelo con el que relacionamos el modelo Imagen
      }
}
