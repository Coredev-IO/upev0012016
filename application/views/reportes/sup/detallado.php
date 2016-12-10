<div class="row">
        <div class="col-md-12">
          <?php
            echo "<label>".$unidad[0]->NombreUnidad." - ".$unidad[0]->Siglas."</label>";
            ?>
        </div>
</div>
<hr>

<div class="row">



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

        </div>
</div>


</div>
