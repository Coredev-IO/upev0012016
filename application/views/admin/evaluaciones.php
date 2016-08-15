<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#evmed" role="tab" data-toggle="tab">Evaluaciones Nivel Medio Superior</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#evsup" role="tab" data-toggle="tab">Evaluaciones Nivel Superior</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="evmed">
          <table id="table-user" class="table table-sm table-hover table-striped">
             <thead class="thead-inverse">
               <tr>
                 <th>Siglas</th>
                 <th>Unidad</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>

<?php

foreach ($unidadesMedioSuperior as $row) {
        echo "<tr>";
	echo "<td>".($row->Siglas)."</td>";
	echo "<td>".($row->NombreUnidad)."</td>";
	echo '<td><a href="'.base_url().'index.php/admin/evaluacion_media_detalle/'.$row->idUnidad.'" class="btn btn-outline-warning btn-sm btn-100">Administrar</a></td>';
	echo "</tr>";
}


 ?>
 </tbody>
 </table>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="evsup">
          <table id="table-user" class="table table-sm table-hover table-striped">
             <thead class="thead-inverse">
               <tr>
                 <th>Siglas</th>
                 <th>Unidad</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>

<?php

foreach ($unidadesSuperior as $row) {
        echo "<tr>";
	echo "<td>".($row->Siglas)."</td>";
	echo "<td>".($row->NombreUnidad)."</td>";
	echo '<td><a href="'.base_url().'index.php/admin/evaluacion_superior_detalle/'.$row->idUnidad.'" class="btn btn-outline-warning btn-sm btn-100">Administrar</a></td>';
	echo "</tr>";
}


 ?>
 </tbody>
 </table>
  </div>
</div>
