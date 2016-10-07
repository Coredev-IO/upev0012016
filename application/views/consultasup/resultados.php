<div class="row">
        <div class="col-md-12">
        <?php echo "<label>".$unidad[0]->NombreUnidad."</label>";?>
        </div>
</div>
<hr>

<div class="row">
        <div class="col-lg-4 col-xs-12">
                <div class="card text-xs-center">
                          <div class="card-header">
                            TOTALES
                          </div>
                          <div class="card-block">
                                   <table class="table table-bordered totaltable">
                                  <thead>
                                    <tr>
                                      <th>Funciones</th>
                                      <th>Totales</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                        $total = 0;
                                        foreach ($resumen['bloque'] as $row) {
                                                # code...
                                                echo '<tr>';
                                                echo '<td>'.$row['nombre'].'</td>';

                                                echo '<td  class="totaltable">'.$row['total'].'%</td>';
                                                $total = $total+$row['total'];
                                                echo '</tr>';
                                        }

                                  ?>
                                          </tbody>
                                </table>

                          </div>
                          <div class="card-footer text-muted">

                                        Total<h1><?php echo $total?>%</h1><?php echo $resTexto.'<br>'.$resComentario; ?>
                         </div>
                </div>

</div>

<!-- <div class="col-lg-8 col-xs-12">
        <div class="card text-xs-center">
                  <div class="card-header">
                    DESEMPEÑO
                  </div>
                  <div class="card-block">

                  </div>
                  <div class="card-footer text-muted">FINALIZANDO</div>
        </div>
</div> -->


</div>
