
<div class="row">
        <div class="col-md-12">
                <?php
                	//creas un select
                	echo '<H5>EVALUACIONES</H5><br>';

                  echo "<table class='table table-bordered totaltable'>
                  <thead>
                    <tr>
                      <th>Unidad</th>
                      <th>Siglas</th>
                      <th>Fecha de evaluación</th>
                      <th>Estatus</th>
                      <th></th>
                    </tr>
                  </thead>";
                  foreach ($unidadesEv as $row) {
                    switch ($row['estado']) {
                      case "ACT":
                              $classtable = "tblAct";
                              break;
                      case "REV":
                              $classtable = "tblNull";
                              break;
                      case "FIN":
                              $classtable = "tblfin";
                              break;
                      case "RES":
                              $classtable = "tblNull";
                              break;
                      case "CAN":
                              $classtable = "tblcan";
                              break;
                      default:
                              $classtable = "tblNull";
                              break;
                    }


                    echo "<tr class='".$classtable."'><td class='".$classtable."'>".$row['NombreUnidad']."</td>";
                    echo "<td class='".$classtable."'>".$row['Siglas']."</td>";
                    echo "<td class='".$classtable."'>".$row['fechaEvaluacion']."</td>";
                    echo "<td class='".$classtable."'>".$row['estatusEvaluacion']."</td>";
                    echo "<td class='".$classtable."'>";
                    echo '<a href="'.base_url().'index.php/consultams/rev/'.$row['idUnidad'].'" class="btn btn-outline-info">CONSULTAR</a>';
                    echo "</td></tr>";


                  }
                	echo "</table>"


                ?>
        </div>
        </div>
<div class="row">
        <hr>

</div>
<br>



<div class="card text-xs-center">
  <div class="card-header">
    ESTATUS GENERAL DE EVALUACIONES
  </div>
  <div class="card-footer text-muted">
    PARA GENERAR RESULTADOS MÁS CONFIABLES ES NECESARIO FINALIZAR LA REVISÓN DE TODAS LAS EVALUACIONES
    <br>

  </div>
  <div class="col-md-12">
    <?php
    echo '<a href="'.base_url().'index.php/graficasms/" class="btn btn-info">CONSULTAR RESULTADOS</a>';
     ?>
  </div>
</div>
