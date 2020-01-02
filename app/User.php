<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';  //Indicamos la tabla que va a modificar este modelo

    // Definimos una relación OneToMany (uno a muchos) entre Usuarios y sus Imágenes
    // Permite recuperar un array de objetos con todas las Imágenes asociadas a un Usuario
    public function images(){
        return $this->hasMany('App\Images');  //Modelo con el que relacionamos el modelo Imagen
     }
}
