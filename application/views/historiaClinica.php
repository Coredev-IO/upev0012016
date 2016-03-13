

<?php  

foreach ($expediente as $expedientes){
  $responsable   = $expedientes->usermail;
  $paciente      = $expedientes->paciente;
  $especie       = $expedientes->especie;
  $raza          = $expedientes->raza;
  $sexo          = $expedientes->sexo;
  $edad          = $expedientes->edad;
  $color         = $expedientes->color;
  $foto          = $expedientes->foto;
  $fotoRuta      = $expedientes->fotoRuta;
}



?>



  <div class="section-colored principal">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-3">
        
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo $paciente;?></div>
            <div class="panel-body">
              <img data-src="holder.js/140x140" class="img-thumbnail" alt="140x140" src="<?=base_url()?>Recursos/img/perro.jpg" style="width: 140px; height: 140px;">
              <p>
                <?php echo $raza.", ".$edad." meses"?>
              </p>
              <a class="btn btn-primary" href="#"><i class="fa fa-calendar"></i>&nbsp; Agendar Cita</a>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">Expediente Clínico</div>
            <!-- <div class="panel-body">
                <ul>
                  <li>Vacunas:</li>
                  <li>Última desparacitación:</li>
                  <li>Castrado:</li>
                </ul>
            </div> -->
          </div>

          <h2><i class="fa fa-columns"></i>&nbsp;Consultas&nbsp;<i class="fa fa-columns"></i></h2>
 <?php 
      foreach ($historial as $historiales){
        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading">'.$historiales->fecha.'&nbsp;<a href="'.base_url().'index.php/home/eliminarHistorial/'.$historiales->idMascota.'/'.$historiales->id.'"><i class="fa fa-trash-o"></i></a></div>';
        echo '<div class="panel-body">';
        echo ''.$historiales->ExamenClinico.'';
        echo '</div></div>';
      }
  ?>

        </div>




 








        <div class="col-sm-8 col-md-8 col-lg-9">
        



    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-list-alt"></i> Hoja Clinica / Consulta / <?php echo date('j-m-y'); ?></div>
          <div class="panel-body">
            <?php echo form_open('expedientes/newhistorialExpedientes'); ?>
               <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'id', 'id'=>'id', 'type'=>'hidden', 'value'=>$id, 'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <?php echo form_input(array('name'=>'userResponsable', 'id'=>'userResponsable', 'type'=>'hidden', 'value'=>$responsable , 'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameAnamnesis" class="col-sm-2 control-label">Anamnesis</label>
                <div class="col-sm-10">
                  <?php echo form_textarea(array('name'=>'Anamnesis', 'id'=>'Anamnesis', 'value'=>set_value('Anamnesis'), 'placeholder' => 'Anamnesis', 'autofocus'=>'autofocus', 'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameTemperatura" class="col-sm-2 control-label">Temperatura</label>
                <div class="col-sm-2">
                  <?php echo form_input(array('name'=>'Temperatura', 'id'=>'Temperatura', 'type'=>'number', 'value'=>set_value('Temperatura'), 'placeholder' => 'Temperatura', 'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameFC" class="col-sm-2 control-label">FC</label>
                <div class="col-sm-2">
                  <?php echo form_input(array('name'=>'FC', 'id'=>'FC', 'type'=>'number', 'value'=>set_value('FC'), 'placeholder' => 'Frecuencia',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameFR" class="col-sm-2 control-label">FR</label>
                <div class="col-sm-2">
                  <?php echo form_input(array('name'=>'FR', 'id'=>'FR', 'type'=>'number', 'value'=>set_value('FR'), 'placeholder' => 'Frecuencia',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameExamenClinico" class="col-sm-2 control-label">Examen Clínico</label>
                <div class="col-sm-10">
                  <?php echo form_textarea(array('name'=>'ExamenClinico', 'id'=>'ExamenClinico', 'value'=>set_value('ExamenClinico'), 'placeholder' => 'Examen Clínico',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameDx" class="col-sm-2 control-label">Dx</label>
                <div class="col-sm-10">
                  <?php echo form_textarea(array('name'=>'Dx', 'id'=>'Dx', 'value'=>set_value('Dx'), 'placeholder' => 'Dx',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameTratamiento" class="col-sm-2 control-label">Tratamiento</label>
                <div class="col-sm-10">
                  <?php echo form_textarea(array('name'=>'Tratamiento', 'id'=>'Tratamiento', 'value'=>set_value('Tratamiento'), 'placeholder' => 'Tratamiento',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputNameEstudios" class="col-sm-2 control-label">Estudios</label>
                <div class="col-sm-10">
                  <?php echo form_textarea(array('name'=>'Estudios', 'id'=>'Estudios', 'value'=>set_value('Estudios'), 'placeholder' => 'Estudios',  'class'=>'form-control')); echo '<br>'; ?>
                </div>
              </div>
              <div class="form-group">
                <div for="inputNameEstudios" class="col-sm-8 control-label">
                  <?=validation_errors(); ?>
                </div>
                <div class="col-sm-4">
                 <?php echo form_input(array('name'=>'botonSubmit', 'id'=>'botonSubmit', 'type'=>'submit', 'value'=>'Terminar', 'class'=>'btnAdd'));
                  echo form_close(); ?>
                </div>
              </div>
              
          </div>
        </div>
   








        </div>

        

        
      </div>
    </div>
  </div>
