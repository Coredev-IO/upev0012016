<div class="col-md-12">
      <div class="well page active" id="input" style="display: block;">
      <label class="header"><?php echo $datos['Username'].",".$datos['Nombre']." ".$datos['ApellidoPaterno']." ".$datos['ApellidoMaterno']." ".$datos['NombreUnidad']."idUnidad: ".$datos['idUnidad'].", Nivel: ".$datos['Nivel']?></label>
  	  </div>

  	  <div>

<a class="btn btn-primary" href="<?=base_url()?>index.php/nuevaevaluacion">Nueva Evaluación</a>

<table class="table">
	<thead>
		<tr>
			<td>Nombre</td>
			<td>Descripcion</td>
		</tr>
	</thead>
	<tbody>
<?php

$array = $AllEvaluacionesUnidad;

foreach ($array as &$elemento) {

	echo "<tr><td>".$elemento->Nombre."</td><td>".$elemento->Descripcion."</td></tr>";
}

?>
</tbody>
</table>


</div>

</div>
