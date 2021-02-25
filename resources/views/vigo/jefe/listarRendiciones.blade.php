@extends ('layout.plantilla')

@section('contenido')

<style>

  .col{
    margin-top: 15px;
  
    }
  
  .colLabel{
  width: 13%;
  margin-top: 18px;
  
  
  }
  
  
  </style>
  
<div>
  <h3> Rendiciones de Gastos a Reponer </h3>
  <div class="container">
    <div class="row">
      <div class="colLabel">
        <label for="">Nombre Jefe:</label>
      </div>
      <div class="col"> 
        <input type="text" class="form-control" value="{{$empleado->getNombreCompleto()}}" readonly>
      </div>
      

      <div class="colLabel">
        <label for="">Codigo Empleado:</label>
      </div>
      <div class="col"> 
        <input type="text" class="form-control" value="{{$empleado->codigoCedepas}}" readonly>
      </div>
      <div class="w-100"></div> {{-- SALTO LINEA --}} 

      

      
    </div>
  </div>
  
    <nav class = "navbar float-right"> {{-- PARA MANDARLO A LA DERECHA --}}
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar por descripcion" aria-label="Search" id="buscarpor" name = "buscarpor" value ="{{($buscarpor)}}" >
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>

{{-- AQUI FALTA EL CODIGO SESSION DATOS ENDIF xdd --}}
      @if (session('datos'))
        <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
            {{session('datos')}}
          <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true"> &times;</span>
          </button>
          
        </div>
      @ENDIF

    <table class="table" style="font-size: 10pt;">
            <thead class="thead-dark">
              <tr>
                <th width="7%" scope="col">Codigo Rendicion</th> {{-- COD CEDEPAS --}}
                <th width="6%"  scope="col">Fecha Rendicion</th>
                <th width="4%"  scope="col">Sede</th>
                <th width="6%"  scope="col">Empleado </th>
                <th width="25%"  scope="col">Proyecto</th>              
                <th width="4%"  scope="col">Total Recibido</th>
                <th width="4%"  scope="col">Total Gastado</th>
                <th width="4%"  scope="col">Saldo</th>
                <th width="15%"  scope="col">Estado</th>
                <th width="5%"  scope="col">Opciones</th>
                
              </tr>
            </thead>
      <tbody>

        {{--     varQuePasamos  nuevoNombre                        --}}
        @foreach($listaRendiciones as $itemRendicion)

      
            <tr>
              <td>{{$itemRendicion->codigoCedepas  }}</td>
              <td>{{$itemRendicion->fechaRendicion  }}</td>
              <td>{{$itemRendicion->getNombreSede()  }}</td>
              <td>{{$itemRendicion->getNombreSolicitante()  }}</td>
              <td>{{$itemRendicion->getNombreProyecto()  }}</td>
              <td>{{$itemRendicion->totalImporteRecibido  }}</td>
              <td>{{$itemRendicion->totalImporteRendido  }}</td>
              <td>{{$itemRendicion->saldoAFavorDeEmpleado  }}</td>
              
        
              <td style="text-align: center">
                
                <input type="text" value="{{$itemRendicion->getNombreEstado()}}" class="form-control" readonly 
                style="background-color: {{$itemRendicion->getColorEstado()}};
                        width:95%;
                        text-align:center;
                        color: {{$itemRendicion->getColorLetrasEstado()}} ;
                ">
              </td>
                <td>        
                  
                         
                        @if($itemRendicion->estadoDeReposicion == 1) {{-- Si está a espera de reponer --}}   
                          <a  class='btn btn-success' href="{{route('rendicionFondos.verReponer',$itemRendicion->getSolicitud()->codSolicitud)}}">
                            Reponer <i class="fas fa-hand-holding-usd"></i>
                          </a>
                        @else{{-- si está rendida (pa verla nomas ) --}}
                          <a href="{{route('solicitudFondos.ver',$itemRendicion->getSolicitud()->codSolicitud)}}">
                            <h1>
                              <span class="red">S</span>
                            </h1>
                          </a>
                          <a href="{{route('rendicionFondos.ver',$itemRendicion->getSolicitud()->codSolicitud)}}">
                            <h1>
                              <span class="red">R</span>
                            </h1>
                          </a>
                        
                        @endif

                    
                </td>

            </tr>
        @endforeach
      </tbody>
    </table>



</div>
@endsection


<?php 
  $fontSize = '14pt';
?>
<style>
/* PARA COD ORDEN CON CIRCULITOS  */

  span.grey {
    background: #000000;
    border-radius: 0.8em;
    -moz-border-radius: 0.8em;
    -webkit-border-radius: 0.8em;
    color: #fff;
    display: inline-block;
    font-weight: bold;
    line-height: 1.6em;
    margin-right: 15px;
    text-align: center;
    width: 1.6em; 
    font-size : {{$fontSize}};
  }
  


  span.red {
  background:#932425;
   border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
  font-size : {{$fontSize}};
}


span.green {
  background: #5EA226;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
  font-size : {{$fontSize}};
}

span.blue {
  background: #5178D0;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
  font-size : {{$fontSize}};
}

span.pink {
  background: #EF0BD8;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 15px;
  text-align: center;
  width: 1.6em; 
  font-size : {{$fontSize}};
}
   </style>
