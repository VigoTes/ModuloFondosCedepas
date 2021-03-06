<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    public $timestamps = false;

    protected $table = 'activo';

    protected $primaryKey = 'codActivo';

    protected $fillable = [
        'codProyectoDestino','nombreDelBien','caracteristicas','codCategoriaActivo','codSede','placa','codEstado','codEmpleadoResponsable','activo'
    ];

    function getCategoria(){
        $categoria=CategoriaActivo::find($this->codCategoriaActivo);
        return $categoria;
    }
    function getProyecto(){
        $proyecto=Proyecto::find($this->codProyectoDestino);
        return $proyecto;
    }
    
    function getSede(){
        $sede=Sede::find($this->codSede);
        return $sede;
    }

    function getEstado(){
        return EstadoActivo::find($this->codEstado);
    }

    function getResponsable(){
        return Empleado::find($this->codEmpleadoResponsable);
    }
}
