@extends ('layout.plantilla')

@section('contenido')
<div>
  <h3> REPORTES </h3>

{{-- 
- Reporte de gastos por empleados con %.
-	Reporte de gastos por sedes con %.
- Reporte de 
-	Reporte de las solicitudes.
-	Reporte de las rendiciones
 --}}

   
        <form method="POST" action="{{route('rendicionFondos.reportes')}}" onsubmit="return validarTextos()">
          @csrf
            <div class="container">
              <div class="row" style="background-color: red">
           
                <div class="col-sm">
                  
                <label for="">Tipo de Reporte</label>
                </div>
                <div class="col-sm">
                  
                  <div>
                    <select class="custom-select" id="tipoInforme" name="tipoInforme" onchange="cambioSelect()">
                      <option value="0">-- Seleccionar -- </option>
                      <option value="1">Por Sedes </option>
                      <option value="2">Por Empleados </option>
                      <option value="3">Por Proyectos</option>
                      <option value="4">Por Empleados de una Sede</option>
                      
                    </select>
                  </div>


                </div>
                <div class="col-sm">
                  <label for="fechaComprobante">Fecha Inicio</label>
                </div>
                <div class="col-sm">
                 
                  <div class="input-group date form_date " data-date-format="yyyy-mm-dd" data-provide="datepicker">
                    <input type="text"  class="form-control" name="fechaI" id="fechaI"
                          value="{{ Carbon\Carbon::now()->subDay(10)->format('Y-m-d') }}" style="font-size: 10pt;"> 
                    <div class="input-group-btn">                                        
                        <button class="btn btn-primary date-set" type="button">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </div>
                  </div>

                </div>
                <div class="col-sm">
                  <label for="fechaComprobante">Fecha Fin</label>
                </div>

                <div class="col-sm">
                  
                  <div class="input-group date form_date " data-date-format="yyyy-mm-dd" data-provide="datepicker">
                    <input type="text"  class="form-control" name="fechaF" id="fechaF"
                          value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" style="font-size: 10pt;"> 
                    <div class="input-group-btn">                                        
                        <button class="btn btn-primary date-set" type="button">
                            <i class="fas fa-calendar"></i>
                        </button>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
              </div>

              <div class="row"> 
                
                <div class="col-sm" id="labelSede" name="labelSede"  style="display: none">
                  <label for=""> Sede </label>
                </div>
                

                <div class="col-sm" id="selectSede" name="selectSede"  style="display: none">
                  <select class="form-control"  id="ComboBoxSede" name="ComboBoxSede" >
                    <option value="0">-- Seleccionar -- </option>
                    @foreach($listaSedes as $itemSede)
                        <option value="{{$itemSede['codSede']}}" >
                            {{$itemSede->nombre}}
                        </option>                                 
                    @endforeach 
                </select> 
                </div>


                <div class="col-sm">
                </div>
                
                <div class="col-sm">
                </div>
                
                <div class="col-sm">
                </div>
                
                <div class="col-sm">
                </div>
                
                <div class="col-sm">
                </div>
                
              </div>


                          

                
              
            </div>
          
          




        </form>
   

{{-- AQUI FALTA EL CODIGO SESSION DATOS ENDIF xdd --}}
      @if (session('datos'))
        <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
            {{session('datos')}}
          <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true"> &times;</span>
          </button>
          
        </div>
      @ENDIF

 

</div>
@endsection

@section('script')

<script>

    function validarTextos(){
        if( $('#tipoInforme').val() == 4 && $('#ComboBoxSede').val() == 0)
        {
          alert('Seleccione una sede para reportar');
          return false;
        }


      return true;
    }

    function cambioSelect(){
      valor = $('#tipoInforme').val()
      if(valor==4)//empleados de una sede
      {
        document.getElementById('labelSede').style.display='';
        document.getElementById('selectSede').style.display='';
      }else{
        document.getElementById('labelSede').style.display='none';
        document.getElementById('selectSede').style.display='none';
      }


    }


</script>

@endsection