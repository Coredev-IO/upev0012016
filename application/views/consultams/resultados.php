<div class="row">
        <div class="col-md-12">
        <?php echo "<label>".$unidad[0]->NombreUnidad." - ".$unidad[0]->Siglas."</label>";?>
        </div>
</div>
<hr>

<div class="row">
        <div class="col-lg-4 col-xs-12">
                <div class="card text-xs-center">
                          <div class="card-header">
                            CONSOLIDADOS
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
                                        <hr>
                                        <a class="btn btn-info btn-100" href=<?php echo base_url().'/index.php/msrepconsolidados/'.$urldata; ?>>IMPRIMIR</a>


                         </div>
                </div>

</div>


<div class="col-lg-8 col-xs-12">
        <div class="card text-xs-center">
                  <div class="card-header">
                    REPORTE POR FUNCIONES
                  </div>
                  <div class="card-block">
                    <?php



                        $objeto = array();
                        $sum = 0;
                        echo "<table class='table table-bordered totaltable table-det'><tr><th>FUNCIÓN</th><th>PORCENTAJE DE FUNCIÓN</th><th>DIMENSIÓN</th><th>PORCENTAJE ESPERADO</th><th>CÁLCULO DE DIMENSIÓN</th><th>CÁLCULO REAL</th></tr><tbody>";
                        foreach ($calculo as $row) {
                          //Se separa por bloque
                          echo "<tr>";
                          echo "<td>";
                          $objeto2 = array();
                          print_r($row['nombre']);
                          echo "</td>";
                          echo "<td>";
                          echo $row['porcentaje'].'%';
                          echo "</td>";
                          echo "<td>";
                          print_r($row['segundobloque']['nombre']);
                          echo "</td>";
                          echo "<td>";
                          echo $row['segundobloque']['porcentaje'].'%';
                          echo "</td>";
                          echo "<td>";
                          echo $row['segundobloque']['calculoDimension'].'%';
                          echo "</td>";
                          echo "<td>";
                          $op = $row['segundobloque']['calculoDimension']*($row['porcentaje']/100);
                          $sum = $sum+$op;
                          echo $op.'%';
                          echo "</td>";
                          echo "</tr>";

                          // print_r($row);

                          // foreach ($row['tercerbloque'] as $row2) {
                          //   print_r($row2);
                          // }
                        }
                        echo '<tr><td colspan="5"></td><td>'.$sum.'%</td></tr>';
                        echo "</tbody></table>";





                       ?>
                  </div>
                  <div class="card-footer text-muted">
                      <a class="btn btn-info btn-100" href=<?php echo base_url().'/index.php/msrepfunciones/'.$urldata; ?>>IMPRIMIR</a>
                 </div>
        </div>
</div>


<div class="col-xs-12">
        <div class="card text-xs-center">
                  <div class="card-header">
                    REPORTE DETALLADO
                  </div>
                  <div class="card-block">
                    <?php
                    // print_r($calculo);

                      function dataTable($calculo, $funcion){
                        $objeto = array();
                        $sum = 0;
                        $varOb = array();
                        // print_r($calculo);

                        foreach ($calculo as $row) {
                            if($row['nombre']==$funcion){
                              $varOb['nombre']=$row['nombre'];
                              $varOb['porcentaje']=$row['porcentaje'];
                            }

                        }

                        echo "<div class='conttable'>
                              <div class='titulos'>
                              <div class='title'>FUNCIÓN</div>
                              <div class='name'>".$funcion."</div>
                              <div class='porcentaje'>PORCENTAJE GENERAL ESTABLECIDO</div>
                              <div class='porc'>".$varOb['porcentaje']."%</div></div>";

                        echo "<table class='table table-bordered totaltable table-det'><tr><th>DIMENSIÓN</th><th>INDICADOR</th><th>VARIABLE 1</th><th>VALOR</th><th>VARIABLE 2</th><th>VALOR</th><th>CÁLCULO DE INDICADOR</th><th>VALOR DE INDICADOR</th><th>CALIFICACIÓN</th><th>RESULTADO</th></tr><tbody>";

                          foreach ($calculo as $row) {
                            if($row['nombre']==$funcion){
                              // print_r($row);
                              //Se separa por bloque
                              foreach ($row['tercerbloque'] as $row2) {

                                // echo "<hr>";
                                echo "<tr>";
                                echo "<td>";
                                print_r($row['segundobloque']['nombre']);
                                echo "</td>";
                                echo "<td>";
                                print_r($row2['nombre']);
                                echo "</td>";
                                echo "<td>";
                                print_r($row2['var1']);
                                echo "</td>";
                                echo "<td>".$row2['val1']."</td>";
                                echo "<td>";
                                print_r($row2['var2']);
                                echo "</td>";
                                echo "<td>".$row2['val2']."</td>";
                                echo "<td>".round($row2['calculoIndicador'],2)."</td>";
                                echo "<td>".round($row2['calculo'],2)."</td>";
                                echo "<td>".round($row2['calificacion'],2)."</td>";
                                echo "<td>".$row2['resultado']."</td>";
                                echo "</tr>";

                              }
                            }


                            // print_r($row);

                            // foreach ($row['tercerbloque'] as $row2) {
                            //   print_r($row2);
                            // }
                          }
                          echo "</tbody></table></div>";
                        }



                      dataTable($calculo,"DESEMPEÑO");
                      dataTable($calculo,"OFERTA EDUCATIVA");
                      dataTable($calculo,"APOYO");
                      dataTable($calculo,"VINCULACION");
                      dataTable($calculo,"INVESTIGACION");
                      dataTable($calculo,"GESTION ADMINISTRATIVA");




                       ?>
                  </div>
                  <div class="card-footer text-muted">
                      <a class="btn btn-info btn-100" href=<?php echo base_url().'/index.php/msrepdetallado/'.$urldata; ?>>IMPRIMIR</a>
                 </div>
        </div>
</div>



</div>
