<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodoEmpleado extends Model
{
    public $timestamps = false;

    protected $table = 'periodo_empleado';

    protected $primaryKey = 'codPeriodoEmpleado';

    protected $fillable = [
        'fechaInicio','fechaFin','fechaContrato','codTurno','codEmpleado','sueldoFijo','activo','valorPorHora','diasRestantes','codPuesto','codTipoContrato','nombreFinanciador','codAFP','asistencia','nombreProyecto','movito'
    ];

    public function turno(){//
        return $this->hasOne('App\Turno','codTurno','codTurno');//el tercer parametro es de Producto
    }

    public function empleado(){//
        return $this->hasOne('App\Empleado','codEmpleado','codEmpleado');//el tercer parametro es de Producto
    }

    public function puesto(){//
        return $this->hasOne('App\Puesto','codPuesto','codPuesto');//el tercer parametro es de Producto
    }

    public function tipoContrato(){//
        return $this->hasOne('App\TipoContrato','codTipoContrato','codTipoContrato');//el tercer parametro es de Producto
    }

    public function Asistencia(){//
        return $this->hasMany('App\Asistencia','codPeriodoEmpleado','codPeriodoEmpleado');//el tercer parametro es de Producto
    }

    public function SolicitudFalta(){//
        return $this->hasMany('App\SolicitudFalta','codPeriodoEmpleado','codPeriodoEmpleado');//el tercer parametro es de Producto
    }

    public function avances(){//
        return $this->hasMany('App\AvanceEntregable','codPeriodoEmpleado','codPeriodoEmpleado');//el tercer parametro es de Producto
    }

    public function parametros(){
        $asistencias=Asistencia::where('codPeriodoEmpleado','=',$this->codPeriodoEmpleado)->get();
        $contTotal=0;
        $contAsistencias=0;
        $contTardanzas=0;

        foreach ($asistencias as $itemasistencia) {
            if(!is_null($itemasistencia->fechaHoraEntrada)){
                if($itemasistencia->fechaHoraEntrada){
                    $item=date('H:i:s', strtotime($itemasistencia->fechaHoraEntrada));
                    if($item>strtotime($itemasistencia->periodoEmpleado->turno->horaInicio)){
                        $contTardanzas++;
                    }
                }
                $contAsistencias++;
            }
            if(!is_null($itemasistencia->fechaHoraEntrada2)){
                if($itemasistencia->fechaHoraEntrada2){
                    $item=date('H:i:s', strtotime($itemasistencia->fechaHoraEntrada2));
                    if($item>strtotime($itemasistencia->periodoEmpleado->turno->horaInicio2)){
                        $contTardanzas++;
                    }
                }
                $contAsistencias++;
            }
            $contTotal+=2;
        }
    }
}
