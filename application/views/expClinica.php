



  <div class="section-colored principal">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="<?=base_url()?>index.php/home/newExpediente" id='btnCorreo' class="button" >Nuevo expediente <i class="fa fa-stethoscope fa-lg"></i> </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
        </div>

        <!-- <div class="col-sm-4 col-md-6 col-lg-7">
            <input type="text" class="form-control" placeholder="Buscar por nombre de mascota">
        </div> -->

        

        
      </div>
    </div>
  </div>



<div class="container">
<div class="row">
<div class="col-sm-12">   
  <?php 
      foreach ($expedientes as $expediente){
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">';
        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading">&nbsp;<a href="'.base_url().'index.php/home/updateExpediente/'.$expediente->id.'"><i class="fa fa-edit"></i></a>&nbsp;<a href="'.base_url().'index.php/home/eliminarExpediente/'.$expediente->id.'"><i class="fa fa-trash-o"></i></a>&nbsp;'.$expediente->paciente.'</div>';
        echo '<div class="panel-body">';
        echo '<center><img data-src="holder.js/140x140" class="img-thumbnail" alt="140x140" src="'.base_url().'Recursos/img/perro.jpg" style="width: 140px; height: 140px;">';
        echo '<br><b>&nbsp Responsable: </b>'.$expediente->usermail.'<br><br>';
        echo '<a class="btn btn-primary" href="'.base_url().'index.php/expedientes/historialExpedientes/'.$expediente->id.'">Expediente&nbsp;<i class="fa fa-archive"></i></a>';
        echo '</div></div></div>';
      }
  ?>
</div></div></div>
                        
                      





