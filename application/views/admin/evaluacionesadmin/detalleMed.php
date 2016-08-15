
<?php echo $unidad[0]->NombreUnidad?>

<hr>

<?php
if(count($ultimaEvaluacion)>0){
if($ultimaEvaluacion[0]->estado=="ACT" || $ultimaEvaluacion[0]->estado=="REV"){
?>

<div class="card card-outline-danger text-xs-center">
  <div class="card-block">
      <p>NO SE PUEDE ACTIVAR MAS DE UNA EVALUACIÓN, SI REQUIERE UNA NUEVA EVALUACIÓN POR FAVOR FINALICE EL PROCESO DE CAPTURA Y REVISIÓN Ó CANCELE LA EVALUACIÓN EN CURSO </p>

  </div>
</div>

<?php
}else{
?>

<a class="btn btn-outline-success btn-sm btn-100" href="<?=base_url()?>index.php/admin/nueva_evaluacion_med/<?=$unidad[0]->idUnidad?>">NUEVA EVALUACIÓN</a>

<?php
}
}else{
?>
<a class="btn btn-outline-success btn-sm btn-100" href="<?=base_url()?>index.php/admin/nueva_evaluacion_med/<?=$unidad[0]->idUnidad?>">NUEVA EVALUACIÓN</a>

<?php

}
?>



<table id="table-user" class="table table-sm table-hover table-striped">
   <thead class="thead-inverse">
     <tr>
       <th>Fecha de creación</th>
       <th>Estado</th>
       <th>Acciones</th>
     </tr>
   </thead>
   <tbody>

<?php

foreach ($evaluaciones as $row) {
echo "<tr>";
echo "<td>".($row->CreateDate)."</td>";
echo "<td>";

switch ($row->estado) {
        case "ACT":
                echo "EN CURSO";
                break;
        case "REV":
                echo "EN REVISIÓN";
                break;
        case "FIN":
                echo "FINALIZANDO";
                break;
        case "RES":
                echo "RESULTADOS PUBLICADOS";
                break;
        case "CAN":
                echo "CANCELADA";
                break;
        default:
                echo "ERROR";
                break;



}


echo "</td>";

echo "<td>";

switch ($row->estado) {
        case "ACT":
                echo '<a href="'.base_url().'index.php/admin/cancel_ev_med/'.$unidad[0]->idUnidad.'/'.$row->idEvaluacion.'" class="btn btn-outline-danger btn-sm btn-100">Cancelar</a>';
                break;
        case "REV":
                echo '<a href="'.base_url().'index.php/admin/cancel_ev_med/'.$unidad[0]->idUnidad.'/'.$row->idEvaluacion.'" class="btn btn-outline-danger btn-sm btn-100">Cancelar</a>';
                break;
        case "FIN":
                echo "Evaluación concluida";
                break;
        case "RES":
                echo "Evaluación concluida";
                break;
        case "CAN":
                echo "Evaluación cancelada";
                break;
        default:
                echo "ERROR";
                break;



}


echo "</td>";

// echo '<td><a href="'.base_url().'index.php/admin/evaluacion_superior_detalle/'.$row->idUnidad.'" class="btn btn-outline-warning btn-sm btn-100">Administrar</a></td>';
echo "</tr>";
}


?>
</tbody>
</table>
