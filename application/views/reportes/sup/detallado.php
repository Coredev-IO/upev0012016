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

                          echo "<div class='conttable-pdf'>
                                <div class='titulos'>
                                <div class='title'>FUNCIÓN</div>
                                <div class='name'>".$funcion."</div>
                                <div class='porcentaje'>PORCENTAJE GENERAL ESTABLECIDO</div>
                                <div class='porc'>".$varOb['porcentaje']."%</div></div>";

                                echo "<table class='table table-bordered totaltable table-det'><tr><th width='10%' class='pdftext'>DIMENSIÓN</th><th class='pdftext' width='20%'>INDICADOR</th><th  class='pdftext' width='30%'>UNIDAD DE APRENDIZAJE</th><th width='15%' class='pdftext'>VARIABLE 1</th><th width='15%' class='pdftext'>VARIABLE 2</th><th width='10%' class='pdftext'>CÁLCULO DE INDICADOR</th></tr><tbody>";

                            foreach ($calculo as $row) {
                              if($row['nombre']==$funcion){
                                // print_r($row);
                                //Se separa por bloque
                                foreach ($row['tercerbloque'] as $row2) {

                                  // echo "<hr>";
                                  echo "<tr>";
                                  echo "<td class='pdftext'>";
                                  print_r($row['segundobloque']['nombre']);
                                  echo "</td>";
                                  echo "<td class='pdftext'>";
                                  print_r($row2['nombre']);
                                  echo "</td>";
                                  echo "<td class='pdftext'></td>";
                                  echo "<td class='pdftext'>";
                                  print_r($row2['var1']);
                                  echo "</td>";
                                  echo "<td class='pdftext'>";
                                  print_r($row2['var2']);
                                  echo "</td>";
                                  echo "<td class='pdftext'></td>";
                                  // echo "<td>".round($row2['calculoIndicador'],2)."</td>";
                                  // echo "<td>".round($row2['calculo'],2)."</td>";
                                  // echo "<td>".round($row2['calificacion'],2)."</td>";
                                  // echo "<td>".$row2['resultado']."</td>";
                                  echo "</tr>";


                                  $i= 1;
                                  foreach ($carreras as $key => $object) {
                                    if($i==1){
                                      echo "<tr>";
                                      echo "<td class='pdftext' colspan='2' rowspan='".count($carreras)."'></td>";
                                      echo "<td class='pdftext'>";
                                        print_r($object->Nombre);
                                      echo "</td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "</tr>";
                                    }else{
                                      echo "<tr>";
                                      echo "<td class='pdftext'>";
                                        print_r($object->Nombre);
                                      echo "</td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "<td class='pdftext'></td>";
                                      echo "</tr>";
                                    }
                                    $i = $i+1;

                                  }


                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>SUMATORIA DEL INDICADOR</td>";
                                  echo "<td class='color-bg tb-h1'>56%</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>CALIFICACIÓN</td>";
                                  echo "<td class='color-bg tb-h1'>1</td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                  echo "<td class='color-bg tb-rigth' colspan='5'>RESULTADO</td>";
                                  echo "<td class='color-bg tb-h2'>BUENO</td>";
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
