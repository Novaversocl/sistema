<!––Formulario que tendrá los datos en común con create y edit ––>
<h1>{{$modo}} cliente</h1>


@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
<ul>
@foreach($errors->all() as $errors)
<li>{{$errors}}</li>
@endforeach
</ul>
</div>
@endif
 

<div class="form-group">
   


<label for="Rut">Rut</label>
    <input type="text" class="form-control" name="Rut" value="{{isset( $cliente->Rut)?$cliente->Rut:''}}" id="Rut">
   

   <div class="form-group">
    <label for="Nombre">Nombre</label>
    <input type="text" class="form-control" name="Nombre"value="{{isset( $cliente->Nombre)?$cliente->Nombre:''}}" id="Nombre">
   
</div>

   <div class="form-group">
    <label for="Apellidos">Apellidos</label>
    <input type="text" class="form-control" name="Apellidos" value="{{ isset($cliente->Apellidos)?$cliente->Apellidos:''}}" id="Apellidos">
   
    </div>

   <div class="form-group">
    <label for="Correo">Correo</label>
    <input type="text" class="form-control" name="Correo" value="{{ isset($cliente->Correo)?$cliente->Correo:''}}" id="Correo">
    

    </div>
   <div class="form-group">
    <label for="Foto">Foto</label>
    </div>

    @if(isset($cliente->Foto))
    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$cliente->Foto }}" width="100" alt="">
    @endif
<br>
    <input type="file" name="Foto" value=""  id="Foto">
    
<br>
<br>
<br>



    <!––value para no guardar el dato de guardar en el boton ––>
    <input  class="btn btn-success" type="submit" value="{{ $modo }} datos">
    <a class="btn btn-primary" href="{{url('cliente/')}}">Regresar</a>
   