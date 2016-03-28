<div class="well page active  col-md-12">
      <div class="col-md-6" id="input" style="display: block;">
      <label class="header"><?php echo $datos['Username'].",".$datos['Nombre']." ".$datos['ApellidoPaterno']." ".$datos['ApellidoMaterno']." ".$datos['NombreUnidad']."idUnidad: ".$datos['idUnidad'].", Nivel: ".$datos['Nivel']?></label>
      </div>
      <div class="col-md-3 col-md-offset-3" id="input" style="display: block;">
      <label class="header"> <?php echo $datos['NombreUnidad']."idUnidad: ".$datos['idUnidad']?></label>
      </div>

      <div class="col-md-12">
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
      <div class="col-md-3 col-md-offset-9">
      <a class="btn btn-raised btn-primary" href="<?=base_url()?>index.php/nuevaevaluacion">Nueva Evaluación</a>
      </div>



</div>
