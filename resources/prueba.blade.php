@foreach($requerimiento as $requerimiento)

  <section class="col-lg-4" style="display:{{validarlogeado($requerimiento->id_usuario)}};">
    <div class="panel panel-default">

    <div class="panel-heading">Actualizar pedido</div>
    <div class="panel-body">



    <div class="form-group">
  <div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Nota! </strong> <p class="help-block warning">solo modifique los datos que desea actualizar</p>
  </div>
      <label for="ejemplo_email_1">detalles del pedido</label>
      <textarea type="text" class="form-control" rows="3" id="nota_pedido" name="nota_pedido"
             placeholder="ingrese los detalles de su pedido"></textarea >
    </div>



    <div class="form-group">
      <label for="ejemplo_email_1" id="cliente" name="cliente">Cliente</label>
      <select class="form-control" name="cliente_id" id="cliente_id" >
        <option value="null">seleccione el cliente</option>
        @foreach($clientes as $cliente)
          <option value="{{!! $cliente->id_cliente !!}}">{{$cliente->nombre_cliente}}</option>
        @endforeach
      </select>
    </div>


    <div class="form-group">
  <label for="ejemplo_email_1" id="producto" name="producto">producto requerido</label>
  <select class="form-control" name="producto_id" id="producto_id" >
    <option value="null">seleccione el producto</option>
    @foreach($productos as $producto)
      <option value="{{!! $producto->id_producto !!}}">{{$producto->nombre_producto}}</option>
    @endforeach
  </select>

    </div>
    <div class="form-group">
    <label for="ejemplo_email_1">Fecha limite de entrega</label>
    <input id="datetimepicker" type="datetime-local" name="fecha" >
    </div>

    <div class="form-group">
      <label for="ejemplo_archivo_1">Adjuntar un archivo</label>
      <input type="file" id="file[]" name="file[]" multiple value="cero">
      <div class="form-group">
      	<label class="control-label" style="text-shadow: black 0.1em 0.1em 0.2em;">Link</label>
      	<input type="text" class="form-control"  id="link" name="links" placeholder="facebook.com,agenciajaque.com,pinterest.com" >
      <p class="help-block">Si tiene link's puede agregarlos en este campo separados por ","</p>
      </div>
    </div>

  </div>
  </div>
  </section>

</div >
</div>

  @endforeach
