<?php $carreras =  $unidad['carreras'];?>
<div class="row">
        <div class="col-md-12">
        <?php echo "<label>".$unidad['unidad'][0]->NombreUnidad." - ".$unidad['unidad'][0]->Siglas."</label>";?>
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

                        function dataTable2($calculo, $carreras, $funcion){
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

                                echo "<table class='table table-bordered totaltable table-det'><tr><th width='10%'>DIMENSIÓN</th><th width='20%'>INDICADOR</th><th width='30%'>UNIDAD DE APRENDIZAJE</th><th width='15%'>VARIABLE 1</th><th width='15%'>VARIABLE 2</th><th width='10%'>CÁLCULO DE INDICADOR</th></tr><tbody>";

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
                                  echo "<td></td>";
                                  echo "<td>";
                                  print_r($row2['var1']);
                                  echo "</td>";
                                  echo "<td>";
                                  print_r($row2['var2']);
                                  echo "</td>";
                                  echo "<td></td>";
                                  // echo "<td>".round($row2['calculoIndicador'],2)."</td>";
                                  // echo "<td>".round($row2['calculo'],2)."</td>";
                                  // echo "<td>".round($row2['calificacion'],2)."</td>";
                                  // echo "<td>".$row2['resultado']."</td>";
                                  echo "</tr>";

                                  $i= 1;
                                  $j=0;
                                  $sumaRes = 0;
                                  if(count($row2['variables'])>1){
                                    foreach ($carreras as $key => $object) {
                                      if($i==1){
                                        echo "<tr>";
                                        echo "<td colspan='2' rowspan='".count($carreras)."'></td>";
                                        echo "<td>";
                                          print_r($object->Nombre);
                                        echo "</td>";
                                        echo "<td>".$row2['variables'][$j]['var1']."</td>";
                                        echo "<td>".$row2['variables'][$j]['var2']."</td>";
                                        echo "<td>".$row2['variables'][$j]['calculo']."</td>";
                                        echo "</tr>";
                                        $sumaRes = $sumaRes+$row2['variables'][$j]['calculo'];
                                      }else{
                                        echo "<tr>";
                                        echo "<td>";
                                          print_r($object->Nombre);
                                        echo "</td>";
                                        echo "<td>".$row2['variables'][$j]['var1']."</td>";
                                        echo "<td>".$row2['variables'][$j]['var2']."</td>";
                                        echo "<td>".$row2['variables'][$j]['calculo']."</td>";
                                        echo "</tr>";
                                        $sumaRes = $sumaRes+$row2['variables'][$j]['calculo'];
                                      }
                                      $i = $i+1;
                                      $j = $j+1;


                                    }
                                  }else{
                                    echo "<tr>";
                                    echo "<td colspan='2'></td>";
                                    echo "<td>General</td>";
                                    echo "<td>".$row2['variables'][0]['var1']."</td>";
                                    echo "<td>".$row2['variables'][0]['var2']."</td>";
                                    echo "<td>".$row2['variables'][0]['calculo']."</td>";
                                    echo "</tr>";
                                    $sumaRes = $row2['variables'][$j]['calculo'];
                                  }



                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>VALOR</td>";
                                  echo "<td class='color-bg tb-h1'>".$row2['calculo']."</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>CÁLCULO</td>";
                                  echo "<td class='color-bg tb-h1'>".$row2['calculoIndicador']."%</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>CALIFICACIÓN</td>";
                                  echo "<td class='color-bg tb-h1'>".$row2['calificacion']."</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>RESULTADO</td>";
                                  echo "<td class='color-bg tb-h2'>".$row2['resultado']."</td>";
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



                        dataTable2($calculo, $carreras, "DESEMPEÑO");
                        dataTable2($calculo, $carreras, "OFERTA EDUCATIVA");
                        dataTable2($calculo, $carreras, "APOYO");
                        dataTable2($calculo, $carreras, "VINCULACION");
                        dataTable2($calculo, $carreras, "INVESTIGACION");
                        dataTable2($calculo, $carreras, "GESTION ADMINISTRATIVA");




                         ?>
                    </div>
          </div>
  </div>



</div>
