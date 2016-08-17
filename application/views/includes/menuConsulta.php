
<!-- Menu Principal -->
<div class="col-md-3 col-lg-3 col-sm-3">

  <div class="list-group">
  <a href="<?=base_url()?>index.php/consultams/consulta1/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Desempeño</a>
  <a href="<?=base_url()?>index.php/consultams/consulta2/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Oferta Educativa</a>
  <a href="<?=base_url()?>index.php/consultams/consulta3/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Apoyo</a>
  <a href="<?=base_url()?>index.php/consultams/consulta4/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Vinculación</a>
  <a href="<?=base_url()?>index.php/consultams/consulta5/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Investigación</a>
  <a href="<?=base_url()?>index.php/consultams/consulta6/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>" class="list-group-item list-group-item-action">Gestión Administrativa</a>
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
                                        if(isset($evaluacionObj[0]->idEvaluacion)){
                                                echo '<a class="btn btn-outline-danger btn-100" href="'.base_url().'index.php/desempeno/updateEstadoMed/'.$evaluacionObj[0]->idEvaluacion.'">Finalizar captura</a>';
                                        }else{
                                                echo '<a class="btn btn-outline-danger btn-100" href="'.base_url().'index.php/desempeno/updateEstadoSup/'.$evaluacionObj[0]->idEvaluacionSup.'">Finalizar captura</a>';
                                        }


                                }else{
                        ?>
                        <div class="alert alert-warning" role="alert">PARA FINALIZAR EL PRCESO DE CAPTURA DE INFORMACIÓN COMPLETE TODOS LOS BLOQUES </div>
                         <?php
                                }
                                ?>
          </div>
  </p>
</div>



</div>
