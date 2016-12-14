

<!-- Menu Principal -->
<div class="col-md-3 col-lg-3 col-sm-3">

  <div class="list-group">
          <a href="<?=base_url()?>index.php/consultasup/consulta1/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Desempeño</a>
          <a href="<?=base_url()?>index.php/consultasup/consulta2/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Oferta Educativa</a>
          <a href="<?=base_url()?>index.php/consultasup/consulta3/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Apoyo</a>
          <a href="<?=base_url()?>index.php/consultasup/consulta4/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Vinculación</a>
          <a href="<?=base_url()?>index.php/consultasup/consulta5/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Investigación</a>
          <a href="<?=base_url()?>index.php/consultasup/consulta6/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Gestión Administrativa</a>
</div>

<hr>


<div class="card card-block">
    <?php
    echo '<a class="btn btn-info btn-100" href="'.base_url().'index.php/consultasup/calculo/'.$datos['idEvaluacion'].'/previos">RRESULTADOS PREVIOS</a>';
     ?>

  </div>

<hr>



<div class="card card-block">
  <p class="card-text">
          <div class="list-group">
                  <?php

                        if($evaluacionObj[0]->cn1==1
                                && $evaluacionObj[0]->cn2==1
                                && $evaluacionObj[0]->cn3==1
                                && $evaluacionObj[0]->cn4==1
                                && $evaluacionObj[0]->cn5==1
                                && $evaluacionObj[0]->cn6==1
                                && $evaluacionObj[0]->cn7==1
                                && $evaluacionObj[0]->cn8==1
                                && $evaluacionObj[0]->cn9==1
                                && $evaluacionObj[0]->cn10==1
                                && $evaluacionObj[0]->cn11==1
                                && $evaluacionObj[0]->cn12==1
                                && $evaluacionObj[0]->cn13==1){
                                        echo '<div class="alert alert-info" role="alert">NO EXISTEN OBSERVACIONES EN LA EVALUACIÓN </div>';
                                        if(isset($evaluacionObj[0]->idEvaluacion)){
                                                echo '<a class="btn btn-outline-success btn-100" href="'.base_url().'index.php/consultasup/finalizarEstadoSup/'.$datos['idEvaluacion'].'">FINALIZAR REVISÓN</a>';
                                        }else{
                                                echo '<a class="btn btn-outline-success btn-100" href="'.base_url().'index.php/consultasup/finalizarEstadoSup/'.$datos['idEvaluacion'].'">FINALIZAR REVISÓN</a>';
                                        }


                                }else{
                        ?>
                        <div class="alert alert-warning" role="alert">EXISTEN OBSERVACIONES EN LA EVALUACIÓN </div>
                        <a class="btn btn-outline-danger btn-100" href="<?=base_url()?>index.php/consultasup/updateEstadoSup/<?=$datos['idEvaluacion']?>'">SOLICITAR CORRECCIÓN</a>
                         <?php
                                }
                                ?>
          </div>
  </p>
</div>



</div>
