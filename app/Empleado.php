<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Empleado extends Model
{
    protected $table = "empleado";
    protected $primaryKey ="codEmpleado";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

    
    // le indicamos los campos de la tabla 
    protected $fillable = ['codUsuario','nombres','apellidos',
    'fechaNacimiento','codEmpleadoTipo','sexo','activo','codigoEmpleadoCedepas','codProyecto'];


    //le pasamos la id del usuario y te retorna el codigo cedepas del empleado
    public function getNombrePorUser( $idAuth){
        $lista = Empleado::where('codUsuario','=',$idAuth)->get();
        return $lista[0]->nombres;

    } 

    public function esDirector(){
        $proyecto = Proyecto::findOrFail($this->codProyecto); //agarramos el proyecto al que pertenece
        if ($proyecto->codEmpleadoDirector == $this->codEmpleado) //si su cod es igual al del director 
            return true;
        return false;

    }

    public static function getEmpleadoLogeado(){
        $codUsuario = Auth::id();         
        $empleados = Empleado::where('codUsuario','=',$codUsuario)->get();
        
        if(count($empleados)<0) //si no encontró el empleado de este user 
        {error_log('
            
            ERROR : 
            EMPLEADO->getEmpleadoLogeado()
            
            ');
            return false;
        }
        return $empleados[0]; 
    }
    public function usuario(){
        return $this->hasOne('App\User','codUsuario','codUsuario');
    }

    
    public function periodoEmpleado(){//
        return $this->hasMany('App\PeriodoEmpleado','codEmpleado','codEmpleado');


    }




}
