<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#servitab" role="tab" data-toggle="tab">Servicio Social</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#vistastab" role="tab" data-toggle="tab">Prácticas Profesionales</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#proyectotab" role="tab" data-toggle="tab">Proyectos Vinculados</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="servitab">
<?php echo form_open_multipart('vinculacion/update_ServicioSocialSup');?>
<?php
$i            = 0;
$arrPrincipal = array();
//Cantidad de unidades
foreach ($IndicadorMs as $row) {
	$arr = $IndicadorMs[$i];
	$obj = array();
	$j   = 0;
	foreach ($arr as $roww) {
		array_push($obj, $roww);
		$j++;
	}
	array_push($arrPrincipal, $obj);
	$i++;
}

$idBloq     = 43;
$idComplete = 2;
$v1         = $ServicioSocialServ[0];//Primer nivel
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

$NumeroArchivo = 4;
$fileInput     = 1;

foreach ($ServicioSocial as $row) {
	// $ServicioSocial solo es los textos que debn tener los campos
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i      = 1;
		$varID  = "";
		$varID2 = "";
		print_r($row["Nombre"]);
		if ($row["Nombre"] == "Alumnos Inscritos Participando en Servicio Social") {$varID = "a"; $varID2 = "z";};
		//Pinta los titulos de las escuelas/carreras
		$prinArr = 0;
		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor     = $arrsec[$idBloq];
				$newidBloq = $idBloq+1;
				$valor2    = $arrsec[$newidBloq];
			}
			foreach ($arrsec as $value) {

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
		echo '<div class="divider"></div></div>';
		$idComplete++;
		$idBloq++;
		$idBloq++;
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
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
  <!-- **************************************************************************************************************** -->

  <div role="tabpanel" class="tab-pane fade" id="vistastab">
<?php echo form_open_multipart('vinculacion/update_VisitasEscolaresSup');?>
<?php
$i            = 0;
$arrPrincipal = array();
//Cantidad de unidades
foreach ($IndicadorMs as $row) {
	$arr = $IndicadorMs[$i];
	$obj = array();
	$j   = 0;
	foreach ($arr as $roww) {
		array_push($obj, $roww);
		$j++;
	}
	array_push($arrPrincipal, $obj);
	$i++;
}

$idComplete = 2;
$v1         = $VisitasEscolaresServ[0];//Primer nivel
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

$NumeroArchivo = 4;
$fileInput     = 1;

foreach ($VisitasEscolares as $row) {
	// $ServicioSocial solo es los textos que debn tener los campos
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                                                     = 1;
		$varID                                                                                 = "";
		$varID2                                                                                = "";
		if ($row["Nombre"] == "Alumnos inscritos Realizando Prácticas Profesionales") {$varID = "b"; $varID2 = "y";};
		//Pinta los titulos de las escuelas/carreras
		$prinArr = 0;
		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor     = $arrsec[$idBloq];
				$newidBloq = $idBloq+1;
				$valor2    = $arrsec[$newidBloq];
			}
			foreach ($arrsec as $value) {

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
		echo '<div class="divider"></div></div>';
		$idComplete++;
		$idBloq++;
		$idBloq++;
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
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
  <!-- **************************************************************************************************************** -->

  <div role="tabpanel" class="tab-pane fade" id="proyectotab">
<?php echo form_open_multipart('vinculacion/update_ProyectosVinculadosSup');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $ProyectosVinculadosServ[0];
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

$NumeroArchivo = 4;

$fileInput = 1;

foreach ($ProyectosVinculados as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i       = 1;
		$varID   = "";
		$prinArr = 0;

		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			// echo "<br>---------------><br>";
			// print_r($arrsec);
			// echo "#";
			// echo $idBloq;
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor = $arrsec[$idBloq];
			}
			foreach ($arrsec as $value) {
				// print_r($value[$prinArr2]);
				// echo $value;
				// if ($value[2] == $roww["idBloques"]) {
				// 	$valor = $value[5];
				// }
			}
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$roww["Nombre"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.' required></div><br></div></div></div>';
			$i = $i+1;
			$prinArr++;
		}
		$idComplete++;

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
		$idComplete++;
		$idBloq++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		$idComplete++;
		echo '<div class="divider"></div></div>';
	}
	echo "<div class='text-file'>Adjunte un archivo para validar la información ingresada en el formulario (formatos válidos: PDF, RAR y ZIP)</div>";
	if (strlen($al[$NumeroArchivo]) > 0) {
		$splName = explode('/', $al[$NumeroArchivo]);
		if (strlen($splName[4]) >= 6) {echo "<label class='alert alert-info'>Archivo agregado: ".$splName[4]."</label><input type='hidden' name='dataSrc".$fileInput."' value='".$al[$NumeroArchivo]."'> <a class='btn btn-outline-warning btn-sm' href='".base_url().$al[$NumeroArchivo]."' download>Ver archivo</a>";}}
	echo '<input class="btn-input-file" type="file" accept=".pdf, .rar, .zip"  name="datafile'.$fileInput.'" multiple/>';
	$fileInput++;
	$NumeroArchivo++;
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
