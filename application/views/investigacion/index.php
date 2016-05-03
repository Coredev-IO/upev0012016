<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
          <ul id="myTabs" role="tablist" class="nav nav-tabs">
            <li role="presentation" class="active"><a id="apoyo-tab" href="#apoyo" role="tab" data-toggle="tab" aria-controls="apoyo" aria-expanded="true">Apoyo de la investigación a la docencia</a></li>
            <li role="presentation"><a id="participacion-tab" href="#participacion" role="tab" data-toggle="tab" aria-controls="participacion" aria-expanded="false">Participación de los alumnos en investigaciones</a></li>
          </ul>
          <br>
          <div id="myTabContent" class="tab-content">

<div id="apoyo" role="tabpanel" aria-labelledby="apoyo-tab" class="tab-pane fade active in">
<?php echo form_open_multipart('investigacion/update_Profesores');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $ApoyoDocenciaServ[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}
$NumeroArchivo = 4;

$fileInput = 1;

foreach ($ApoyoDocencia as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Indicadores"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id=b'.$i.' name=b'.$i.' required></div><br></div></div></div>';
			$i = $i+1;
		}
		$idComplete++;

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	}

	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-raised btn-success' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" name="datafile'.$fileInput.'"/>';
	$fileInput++;
	$NumeroArchivo++;
}
echo '<button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
<!-- </div> -->
</div>


<div id="participacion" role="tabpanel" aria-labelledby="participacion-tab" class="tab-pane fade">
<?php echo form_open_multipart('investigacion/update_Alumnos');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $ParticipacionAlmunnosServ[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 4;

$fileInput = 1;
foreach ($ParticipacionAlmunnos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Indicadores"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id=b'.$i.' name=b'.$i.' required></div><br></div></div></div>';
			$i = $i+1;
		}
		$idComplete++;

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	}

	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-raised btn-success' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" name="datafile'.$fileInput.'"/>';
	$fileInput++;
	$NumeroArchivo++;

}
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-raised btn-success">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
<!-- </div> -->
</div>

      <!-- Termina "myTabContent" -->
      </div>
    </div>
  </div>
</div>



