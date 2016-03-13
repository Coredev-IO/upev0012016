<div class="section-colored fondo">

      <div class="container">

        <div class="row">
          <div class="col-md-2 col-sm-2">

          </div>
          <div class="col-md-8 col-sm-8">



          <div class="modal-content">
                    <div class="modal-header">
                    
                      <h4 class="modal-title">Ususario ya existe</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo $usuario;?>
                      <p>Ususario ya existe</p>
                      <input class="textbtn" id="correo" type="text" placeholder="Escribe tu email" autofocus required>
                      <a  id='btnCorreo' class="button" >REGÍSTRATE</a>

                    </div>
                    <div class="modal-footer">
                      
                    </div>
                  </div>

          </div>

          <div class="col-md-2 col-sm-2">
           
          </div>
          
          
        </div><!-- /.row -->

      </div><!-- /.container -->

    </div><!-- /.section-colored -->


<script language="JavaScript" type="text/javascript">

   


  $('#btnCorreo').click(function(){


      
      var correo = $("#correo").val();
      if (correo==''){

      }else{
      //correo = hex_md5(correo);

      var pagina="<?=base_url()?>index.php/email/vet/"+correo;

      location.href=pagina;}


  });




</script>

