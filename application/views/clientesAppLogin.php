<div class="section-colored fondo">

      <div class="container">

        <div class="row">
          <div class="col-md-3 col-sm-3 col-lg-4">

          </div>
          <div class="col-md-6 col-sm-6 col-lg-4">



          <div class="modal-content">
                    <div class="modal-header">
                    
                      <h4 class="modal-title">Iniciar sesión</h4>
                    </div>
                    <div class="modal-body">
                    <?php echo validation_errors(); ?>
                     <?php echo form_open('verifylogin'); ?>
                      <input type="text" class="textbtn" value="" placeholder="Correo" id="username" name="username" autofocus>
                      <input type="password" class="textbtn" value="" placeholder="Password" id="login-pass" id="passowrd" name="password">
                      <input class="button" type="submit" value="INICIAR"/>

                    </div>
                    <div class="modal-footer">
                      <a  data-toggle="modal" data-target="#myModal">Recuperar Contraseña</a>
                    </div>
                  </div>

          </div>

          <div class="col-md-3 col-sm-3 col-lg-4">
           
          </div>
          
          
        </div><!-- /.row -->

      </div><!-- /.container -->

    </div><!-- /.section-colored -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Recuperar Contraseña</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="textbtn2" value="" placeholder="Ingrese Correo Electrónico" id="usernameRecuperar" name="username2" autofocus>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="recuperar()">Recuperar</button>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">

function recuperar(){
  var usuario=$("#usernameRecuperar").val();
  var pagina="<?=base_url()?>index.php/api/";

  $.ajax({
        url: pagina+"usuariosClientes/recoveryAccountAleatorio",
        data:{
          username: usuario
        },
                  type: "POST",
                  dataType: "json",
                  success: function(source){
                    //console.log(source);
                    if (source.success === 1){
                      
                      // $('#myModalAdd').hide();
                      // usuarios();
                    }else
                  {
                    //alert('Error al eliminar, es posible que tenga dependencias ');
                    //console.log(source)
                    //$('#errores').text(source.error_message)
                  }//data = source;

                      //generarDatos(source);



                  },
                  error: function(dato){
                    //console.log(JSON.stringify(dato));
                    //alert("ERROR");
                  }
                }); //end ajax


}







</script>




