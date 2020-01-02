<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';  //Indicamos la tabla que va a modificar este modelo

    // Definimos una relación ManyToOne (muchos a uno) entre Comentarios y Usuario
    // Permite recuperar el usuario que subió una Imagen
    public function user(){
        return $this->belongsTo('App\User','user_id');  //Modelo con el que relacionamos el modelo Like
    }

    // Definimos una relación ManyToOne (muchos a uno) entre Comentarios e Imagen
    // Permite recuperar el usuario que subió una Imagen
    public function image(){
        return $this->belongsTo('App\Image','image_id');  //Modelo con el que relacionamos el modelo Like
    }
}
