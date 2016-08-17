

<!-- Menu Principal -->
<div class="col-md-3 col-lg-3 col-sm-3">

  <div class="list-group">
  <a href="<?=base_url()?>index.php/desempeno/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Desempeño</a>
  <a href="<?=base_url()?>index.php/oferta/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Oferta Educativa</a>
  <a href="<?=base_url()?>index.php/apoyo/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Apoyo</a>
  <a href="<?=base_url()?>index.php/vinculacion/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Vinculación</a>
  <a href="<?=base_url()?>index.php/investigacion/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Investigación</a>
  <a href="<?=base_url()?>index.php/gestion/reg/<?=$idUrl?>" class="list-group-item list-group-item-action">Gestión Administrativa</a>
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
                                        echo '<a class="btn btn-outline-danger btn-100" href="<?=base_url()?>index.php/logout">Finalizar captura</a>';

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
