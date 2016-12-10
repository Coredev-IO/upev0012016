<?php $carreras =  $unidad['carreras'];?>
<div class="row">
        <div class="col-md-12">
          <?php echo "<label>".$unidad['unidad'][0]->NombreUnidad." - ".$unidad['unidad'][0]->Siglas."</label>";?>
        </div>
</div>
<hr>

<div class="row">


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

  </div>
</div>


</div>
