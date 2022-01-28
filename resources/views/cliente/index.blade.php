

@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">

{{Session::get('mensaje')}}



</div>
@endif


<td>



<a href="{{url('cliente/create')}}"class="btn btn-success" >Registrar Nuevo Cliente </a>
<td>
    <br>
    <br>

<! –– con comando se agrega la tabla más rápida: b-table headers––>
<table class="table table-light">
    <thead class="thead-light">
        <tr>

        <! –– el id primero ––>
           <th>Foto</th>
            <th>#</th>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
            
            <th>Acciones</th>
        </tr>
    </thead>



    <tbody>
        @foreach( $clientes as $cliente )
        <tr>
        <! –– el id primero  deben tener los mismos nombres que la bd ––>
        <th><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$cliente->Foto }}" width="100" alt=""></th>
            <th>{{$cliente->id}}</th>
           
            <th>{{$cliente->Rut}}</th>
            <th>{{$cliente->Nombre}}</th>
            <th>{{$cliente->Apellidos}}</th>
            <th>{{$cliente->Correo}}</th>

            

            
            
         
        <td>
            <a href="{{url('/cliente/'.$cliente->id.'/edit')}}" class="btn btn-warning">
           Editar
            </a>



<form  action="{{url('/cliente/'.$cliente->id)}}" class="d-inline" method="post">
@csrf

{{method_field('DELETE')}}

<input class="btn btn-danger" type="submit" onclick="return confirm ('¿Desea Borrar?)"value="Borrar">



</form>

            </td>


        </tr>
        @endforeach
    </tbody>


   
    

</table>
{!!$clientes->links()!!}
</div>
@endsection