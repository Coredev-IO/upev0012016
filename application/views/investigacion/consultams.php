<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#ivstdocen" role="tab" data-toggle="tab">Apoyo de la investigación a la docencia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#particinv" role="tab" data-toggle="tab">Participación de los alumnos en investigaciones</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="ivstdocen">
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
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$roww["Nombre"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id=b'.$i.' name=b'.$i.' required></div><br></div></div></div>';
			$i = $i+1;
		}
		$idComplete++;

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	}

	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario (formatos válidos: PDF, RAR y ZIP)</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-outline-warning btn-sm' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" accept=".pdf, .rar, .zip"  name="datafile'.$fileInput.'" multiple/>';
	$fileInput++;
	$NumeroArchivo++;
}
// echo '<button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
?>
<?php echo form_open('consultams/updatecomentario');
?>

        <div class="formNoOculto">

        <input type="hidden" name="redirect" value="consultams/consulta5/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="tabla" value="InvestigacionDocencia">
        <input type="hidden" name="idEvaluacion" value="<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="comentario" value="cn11">
        <input type="hidden" name="idUnidad" value="<?=$datos['idUnidad']?>">
        <div class="form-group">
                <textarea rows="8" class="form-control" placeholder="" name="comentarios" ><?php echo $v1->comentarios ?></textarea>
        </div>
        <div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Actualizar revisión<div class="ripple-container"></div></button></div>
        </div>
<?php echo form_close();?>
<?php
echo "</div>";
?>
<!-- </div> -->
  </div>
  <!-- **************************************************************************************************************** -->

  <div role="tabpanel" class="tab-pane fade" id="particinv">
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
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$roww["Nombre"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id=b'.$i.' name=b'.$i.' required></div><br></div></div></div>';
			$i = $i+1;
		}
		$idComplete++;

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	}

	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario (formatos válidos: PDF, RAR y ZIP)</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-outline-warning btn-sm' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" accept=".pdf, .rar, .zip"  name="datafile'.$fileInput.'" multiple/>';
	$fileInput++;
	$NumeroArchivo++;

}
// echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
?>
<?php echo form_open('consultams/updatecomentario');
?>

        <div class="formNoOculto">

        <input type="hidden" name="redirect" value="consultams/consulta5/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="tabla" value="AlumnosInvestigacion">
        <input type="hidden" name="idEvaluacion" value="<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="comentario" value="cn12">
        <input type="hidden" name="idUnidad" value="<?=$datos['idUnidad']?>">
        <div class="form-group">
                <textarea rows="8" class="form-control" placeholder="" name="comentarios" ><?php echo $v1->comentarios ?></textarea>
        </div>
        <div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Actualizar revisión<div class="ripple-container"></div></button></div>
        </div>
<?php echo form_close();?>
<?php
echo "</div>";
?>
<!-- </div> -->
  </div>
</div>
