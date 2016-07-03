<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
          <ul id="myTabs" role="tablist" class="nav nav-tabs">
            <li role="presentation" class="active"><a id="recursos-tab" href="#recursos" role="tab" data-toggle="tab" aria-controls="recursos" aria-expanded="true">Recursos autogenerados</a></li>
          </ul>
          <br>
          <div id="myTabContent" class="tab-content">

<div id="recursos" role="tabpanel" aria-labelledby="recursos-tab" class="tab-pane fade active in">
<?php echo form_open_multipart('gestion/update_rcursos');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $gestion[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 4;

$fileInput = 1;

foreach ($Recursos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
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
	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario (formatos válidos: PDF, RAR y ZIP)</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-raised btn-success' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" accept=".pdf, .rar, .zip"  name="datafile'.$fileInput.'"/>';
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



