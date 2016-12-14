
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
                    echo "<tr><td>".$row['NombreUnidad']."</td>";
                    echo "<td>".$row['Siglas']."</td>";
                    echo "<td>".$row['fechaEvaluacion']."</td>";
                    echo "<td>".$row['estatusEvaluacion']."</td>";
                    echo "<td>";
                    echo '<a href="'.base_url().'index.php/consultasup/rev/'.$row['idUnidad'].'" class="btn btn-outline-info">CONSULTAR</a>';
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
  <div class="card-block">

  </div>
  <div class="card-footer text-muted">
    NO SE PUEDE GENERAR UN REPORTE GENERAL POR QUE NO SE HA CONCLUIDO EL PROCESO DE REVISIÓN PARA TODAS LAS UNIDADES
  </div>
</div>
