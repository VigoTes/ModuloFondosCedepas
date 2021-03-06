@extends('layout.plantilla') 
@section('estilos')
<link rel="stylesheet" href="/calendario/css/bootstrap-datepicker.standalone.css">
<link rel="stylesheet" href="/select2/bootstrap-select.min.css">
@endsection
@section('contenido')
<br>
<div class="container">
    <h1>LISTA DE REVISIONES</h1>
    @if($band==1)
    <a href="{{route('gestionInventario.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>Registrar nueva revisión</a>    
    @endif
    
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Inicio</th>
                        <th scope="col">Termino</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">% No revisado</th>
                        <th scope="col">% Disponible</th>
                        <th scope="col">% No Habido </th>
                        <th scope="col">% Deteriorado</th>
                        <th scope="col">% Donado</th>
                        <th scope="col">Opciones</th>  
                    </tr>
                </thead>
            <tbody>
                @foreach($revisiones as $itemrevision)
                <tr>
                    <td scope="row">{{$itemrevision->fechaHoraInicio}}</td>
                    <td>{{!is_null($itemrevision->fechaHoraCierre)? $itemrevision->fechaHoraCierre : '-'}}</td>
                    <td>{{$itemrevision->getResponsable()->apellidos}}, {{$itemrevision->getResponsable()->nombres}}</td>
                    <td>{{$itemrevision->descripcion}}</td>
                    <td>{{number_format($itemrevision->parametros()[0],2)}}%</td>
                    <td>{{number_format($itemrevision->parametros()[1],2)}}%</td>
                    <td>{{number_format($itemrevision->parametros()[2],2)}}%</td>
                    <td>{{number_format($itemrevision->parametros()[3],2)}}%</td>
                    <td>{{number_format($itemrevision->parametros()[4],2)}}%</td>
                    <td>
                        @if(is_null($itemrevision->fechaHoraCierre))
                        <a href="{{route('gestionInventario.edit',$itemrevision->codRevision)}}" class="btn btn-success btn-sm">EDITAR</a>
                        @endif
                        <a href="{{route('gestionInventario.show',$itemrevision->codRevision)}}" class="btn btn-info btn-sm">VER</a><!--esto falta, revisa el audio xd -->
                        @if(is_null($itemrevision->fechaHoraCierre))
                        
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    <div>
</div>


@endsection

@section('script')  
    <script src="/select2/bootstrap-select.min.js"></script>     
     <script src="/calendario/js/bootstrap-datepicker.min.js"></script>
     <script src="/calendario/locales/bootstrap-datepicker.es.min.js"></script>
     <script src="/archivos/js/createdoc.js"></script>
@endsection