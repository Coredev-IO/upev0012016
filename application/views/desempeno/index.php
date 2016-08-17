<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#alumnos" role="tab" data-toggle="tab">Alumnos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#docentes" role="tab" data-toggle="tab">Docentes</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="alumnos">

<?php echo form_open_multipart('desempeno/updateAlumnos');?>
<!-- <div class="row"> -->
<?php

$i            = 0;
$arrPrincipal = array();
//Cantidad de unidades
foreach ($IndicadorMs as $row) {
	$arr = $IndicadorMs[$i];
	$obj = array();
	$j   = 0;
	foreach ($arr as $roww) {
		// print_r($roww);
		//
		//
		array_push($obj, $roww);
		// echo "<br>";
		$j++;
	}
	// print_r($obj);
	array_push($arrPrincipal, $obj);
	// echo "<hr><br>";
	$i++;
}

// print_r($arrPrincipal[0]);
// echo "<br>---------------><br>";
// print_r($arrPrincipal[1]);
$idBloq     = 5;
$idComplete = 2;
$v1         = $Alumnos[0];
$longitud =  strlen(str_replace(' ', '', $v1->comentarios));
if($longitud>0){
?>
<br>
<div class="alert alert-danger" role="alert">
  <?php echo $v1->comentarios;?>
</div>
<?php
}
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 10;

$fileInput = 1;

foreach ($nivelAlumnos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                      = 1;
		$varID                                                  = "";
		if ($row["Nombre"] == "Rendimiento") {$varID            = "a"; $varID2            = "z";};
		if ($row["Nombre"] == "Eficiencia terminal") {$varID    = "b"; $varID2    = "y";};
		if ($row["Nombre"] == "Titulación") {$varID            = "c"; $varID2            = "x";};
		if ($row["Nombre"] == "Promoción de NMS a NS") {$varID = "d"; $varID2 = "w";};
		$prinArr                                                = 0;

		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			// echo "<br>---------------><br>";
			// print_r($arrsec);
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor     = $arrsec[$idBloq];
				$newidBloq = $idBloq+1;
				// $idBloq++;
				$valor2 = $arrsec[$newidBloq];
			}
			foreach ($arrsec as $value) {
				// print_r($value[$prinArr2]);
				// echo $value;
				// if ($value[2] == $roww["idBloques"]) {
				// 	$valor = $value[5];
				// }
			}
			echo '<div class="col-md-12">
                                        <div class="row inputs-form">
                                                <div class="col-md-6">'.$roww["Nombre"].'</div>
                                                <div class="col-md-3">
                                                        <div class="form-group label-floating is-empty">
                                                                <input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.' required>
                                                        </div>
                                                        <br>
                                                </div>
                                                <div class="col-md-3">
                                                        <div class="form-group label-floating is-empty">
                                                                <input type="text" value="'.$valor2.'" class="form-control" id='.$roww["idBloques"].'-'.$varID2.'-'.$i.' name='.$roww["idBloques"].'-'.$varID2.'-'.$i.' required>
                                                        </div>
                                                        <br>
                                                </div>
                                        </div>
                                </div>';
			$i = $i+1;

			$prinArr++;
		}
		$idComplete++;

		// echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
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

	$idBloq++;
	$idBloq++;

}

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
  <!-- **************************************************************************************************************** -->
  <div role="tabpanel" class="tab-pane fade" id="docentes">

<?php echo form_open_multipart('desempeno/updateDocencia');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $Docentes[0];
$longitud =  strlen(str_replace(' ', '', $v1->comentarios));
if($longitud>0){
?>
<br>
<div class="alert alert-danger" role="alert">
  <?php echo $v1->comentarios;?>
</div>
<?php
}
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$fileInput     = 1;
$NumeroArchivo = 10;
$idBloq        = $idBloq;
foreach ($nivelDocentes as $row) {
	//
	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i      = 1;
		$varID  = "";
		$varID2 = "";

		if ($row["Indicadores"] == "Aprovechamiento de la Planta Docente") {$varID                   = "e"; $varID2                   = "v";};
		if ($row["Indicadores"] == "Docentes de Asignatura activos en el Sector Productivo") {$varID = "f"; $varID2 = "u";};
		if ($row["Indicadores"] == "Docentes actualizados en el Área Disciplinar") {$varID          = "g"; $varID2          = "t";};
		if ($row["Indicadores"] == "Desempeño Docente") {$varID                                     = "h"; $varID2                                     = "s";};
		$prinArr                                                                                     = 0;

		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			// echo "<br>---------------><br>";
			// print_r($arrsec);
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor     = $arrsec[$idBloq];
				$newidBloq = $idBloq+1;
				// $idBloq++;
				$valor2 = $arrsec[$newidBloq];
			}
			foreach ($arrsec as $value) {
				// print_r($value[$prinArr2]);
				// echo $value;
				// if ($value[2] == $roww["idBloques"]) {
				// 	$valor = $value[5];
				// }
			}
			echo '<div class="col-md-12">
                                        <div class="row inputs-form">
                                                <div class="col-md-6">'.$roww["Nombre"].'</div>
                                                <div class="col-md-3">
                                                        <div class="form-group label-floating is-empty">
                                                                <input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.' required>
                                                        </div>
                                                        <br>
                                                </div>
                                                <div class="col-md-3">
                                                        <div class="form-group label-floating is-empty">
                                                                <input type="text" value="'.$valor2.'" class="form-control" id='.$roww["idBloques"].'-'.$varID2.'-'.$i.' name='.$roww["idBloques"].'-'.$varID2.'-'.$i.' required>
                                                        </div>
                                                        <br>
                                                </div>
                                        </div>
                                </div>';
			$i = $i+1;
			$prinArr++;
		}
		$idComplete++;

		// echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
	}
	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario (formatos válidos: PDF, RAR y ZIP)</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'><a class='btn btn-outline-warning btn-sm' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" accept=".pdf, .rar, .zip"  name="datafile'.$fileInput.'" multiple/>';
	$fileInput++;
	$NumeroArchivo++;

	$idBloq++;
	$idBloq++;
}
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
</div>
