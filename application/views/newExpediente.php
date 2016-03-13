<div class="section-colored principal">
  <div class="container">
    <div class="row">
      <div class="col-sm-12  col-md-offset-2 col-md-8  col-lg-offset-2 col-lg-8">
        <div class="panel panel-default">
          <div class="panel-heading">Nuevo Expediente Clínico</div>
          <div class="panel-body">
            <?php echo form_open_multipart('expedientes/newExpedientes'); ?>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Responsable</label>
                <div class="col-sm-9">
                  <?php echo form_input(array('name'=>'responsable', 'id'=>'responsable', 'type'=>'text', 'value'=>set_value('responsable'), 'placeholder' => 'Seleccione un usuario o registre uno nuevo',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
                <div class="col-sm-1">
                  <a data-toggle="modal" data-target="#myModal" onclick="usuarios();"><i class="fa fa-users"></i></a>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Paciente</label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'nombre', 'id'=>'nombre', 'type'=>'text', 'value'=>set_value('nombre'), 'placeholder' => 'Ingrese el nombre de la mascota', 'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Especie</label>
                <div class="col-sm-9">
                  <?php echo form_input(array('name'=>'especie', 'id'=>'especie', 'type'=>'text', 'value'=>set_value('especie'), 'placeholder' => 'Ingrese la especie',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
                <div class="col-sm-1">
                  <a data-toggle="modal" data-target="#myModalEspecie" onclick="especies();"><i class="fa fa-dot-circle-o"></i></a>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Raza</label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'raza', 'id'=>'raza', 'type'=>'text', 'value'=>set_value('raza'), 'placeholder' => 'Ingrese la raza',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Sexo</label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'sexo', 'id'=>'sexo', 'type'=>'text', 'value'=>set_value('sexo'), 'placeholder' => 'Ingrese el sexo de la mascota',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Edad</label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'edad', 'id'=>'edad', 'type'=>'number', 'value'=>set_value('edad'), 'placeholder' => 'Ingrese la edad en meses',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNamePaciente" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'color', 'id'=>'color', 'type'=>'text', 'value'=>set_value('color'), 'placeholder' => 'Defina el color aproximado de la mascota',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <?=validation_errors(); ?>

              <div class="section-colored principal">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12  col-md-12 col-lg-12">
                      <div class="row">
                        <div class="col-sm-12 col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4">
                          <?php echo form_input(array('name'=>'botonSubmit', 'id'=>'botonSubmit', 'type'=>'submit', 'value'=>'Crear Expediente', 'class'=>'btnAdd'));
                                echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                    </div>
                  </div>
                </div>
              </div>


          </div>
        </div>
        


      </div>
    
<!--       <div class="col-sm-12 col-md-4 col-lg-3">
        <div class="thumbnail">
          <p></p>

          <i class="fa fa-camera-retro fa-5x"></i>
          <br>Agregar una foto</br>
          <input type="file" name="foto" />
          <p></p>
        </div>
      </div> -->
    </div>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Seleccione un usuario</h4>
      </div>
      <div class="modal-body">
        <center><div id="table"><table id="data"></table></div></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdd" >Agregar nuevo usuario</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="usuario()">Continuar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalEspecie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabelespecie">Seleccione una especie</h4>
      </div>
      <div class="modal-body">
        <center><div id="table"><table id="data2"></table></div></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#" >Agregar nueva aspecie</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="especie()">Continuar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabelAdd">Agregar Usuario a petCloud</h4>
      </div>
      <div class="modal-body">
        <input id="correoNuevoUsuario" placeholder="Ingrese un correo electronico" type="email" class="form-control">
        <label id="errores"></label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="usuariosAleatorios()">Continuar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

function usuariosAleatorios(){
  var usuario=$("#correoNuevoUsuario").val();
  var pagina="<?=base_url()?>index.php/api/";

  $.ajax({
        url: pagina+"usuariosClientes/newAccountAleatorio",
        data:{
          username: usuario
        },
                  type: "POST",
                  dataType: "json",
                  success: function(source){
                    //console.log(source);
                    if (source.success === 1){
                      
                      $('#myModalAdd').hide();
                      usuarios();
                    }else
                  {
                    //alert('Error al eliminar, es posible que tenga dependencias ');
                    //console.log(source)
                    $('#errores').text(source.error_message)
                  }//data = source;

                      //generarDatos(source);



                  },
                  error: function(dato){
                    //console.log(JSON.stringify(dato));
                    //alert("ERROR");
                  }
                }); //end ajax


}




  function usuario(){
    var usuario =$("#myModalLabel").text();
    $("#responsable").val(usuario);

  }


  function usuarios(){
  var pagina="<?=base_url()?>index.php/api/";
    $.ajax({
        url: pagina+"usuariosClientes/todosUsuarios",
        data:{},
                  type: "POST",
                  dataType: "json",
                  success: function(source){
                    //console.log(source);
                    

                      generarDatos(source);



                  },
                  error: function(dato){
                    //console.log(JSON.stringify(dato));
                    alert("ERROR");}
                }); //end ajax
  }



    function generarDatos(usuarios){
      $('#data').empty();
                    $.each(usuarios, function(index, usuario) {
                      //console.log(usuario.username);
                      $("#data").append('<tr><td width="100%" height="10px">'+
                        usuario.username+'</td><td width="30%">'+
                        '<button type="button" class="btn btn-default" title="Seleccione" onclick="select(\''+usuario.username+'\')" >'+
                            'Seleccione'+
                          '</button> '
                          +'</td><td width="20%"></td></tr>');
                    });



                  }

      function select(usuario){
        $('#myModalLabel').text(usuario);
      }







      function especies(){
  var pagina="<?=base_url()?>index.php/api/";
    $.ajax({
        url: pagina+"catalogos/todosEspecies",
        data:{},
                  type: "POST",
                  dataType: "json",
                  success: function(source){
                    //console.log(source);
                    

                      generarDatosEspecie(source);



                  },
                  error: function(dato){
                    //console.log(JSON.stringify(dato));
                    alert("ERROR");}
                }); //end ajax
  }



    function generarDatosEspecie(especies){
      $('#data2').empty();
                    $.each(especies, function(index, especie) {
                      //console.log(usuario.username);
                      $("#data2").append('<tr><td width="100%" height="10px">'+
                        especie.nombreEspecie+'</td><td width="30%">'+
                        '<button type="button" class="btn btn-default" title="Seleccione" onclick="select2(\''+especie.nombreEspecie+'\')" >'+
                            'Seleccione'+
                          '</button> '
                          +'</td><td width="20%"></td></tr>');
                    });



                  }


     function select2(especie){
        $('#myModalLabelespecie').text(especie);
      }

      function especie(){
    var especie =$("#myModalLabelespecie").text();
    $("#especie").val(especie);

  }

</script>

