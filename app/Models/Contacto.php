<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = ['producto_id', 'telefono', 'email_contacto'];

    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }
}
