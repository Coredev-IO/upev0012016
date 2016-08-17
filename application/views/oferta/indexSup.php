<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#progacatab" role="tab" data-toggle="tab">Programas Académicos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#infratab" role="tab" data-toggle="tab">Infraestructura</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="progacatab">
<?php echo form_open_multipart('oferta/updateProgramasAcademicosSup');?>
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
		// echo "<br>";a
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
$idBloq     = 23;
$idComplete = 2;
// print_r($ProgramasAcademicos[0]);
$v1 = $ProgramasAcademicos[0];
$longitud =  strlen(str_replace(' ', '', $v1->comentarios));
if($longitud>0){
?>
<br>
<div class="alert alert-danger" role="alert">
  <?php echo $v1->comentarios;?>
</div>
<?php
}
$al = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 6;

$fileInput = 1;

foreach ($nivelProgramasAcademicos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                                  = 1;
		$varID                                                              = "";
		$varID2                                                             = "";
		if ($row["Nombre"] == "Programas Académicos Acreditados") {$varID  = "a"; $varID2  = "z";};
		if ($row["Nombre"] == "Programas Académicos Actualizados") {$varID = "b"; $varID2 = "y";};
		$prinArr                                                            = 0;

		foreach ($bloques as $roww) {
			$prinArr2 = 0;
			//Se traen los valores de los registros
			$valor  = 0;
			$arrsec = array();
			$arrsec = $arrPrincipal[$prinArr];
			// echo "<br>---------------><br>";
			// print_r($arrsec);
			if ($arrsec[2] == $roww["idBloques"]) {
				$valor = $arrsec[$idBloq];

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
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
<!-- </div> -->
  </div>
  <!-- **************************************************************************************************************** -->

  <div role="tabpanel" class="tab-pane fade" id="infratab">
<?php echo form_open_multipart('oferta/update_LaboratoriosSup');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $Infraestructura[0];
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

$NumeroArchivo = 7;

$fileInput = 1;

foreach ($nivelInfraestructura as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                                                                        = 1;
		$varID                                                                                                    = "";
		if ($row["Nombre"] == "Capacidad de atención de alumnos en relación a talleres y laboratorios") {$varID = "c"; $varID2 = "x";};
		if ($row["Nombre"] == "Aulas Equipadas") {$varID                                                          = "d"; $varID2                                                          = "w";};
		if ($row["Nombre"] == "Laboratorios Equipado") {$varID                                                    = "e"; $varID2                                                    = "v";};
		$prinArr                                                                                                  = 0;

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
		$idBloq++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';

		if (strlen($row["campo2"]) > 0) {
			$idComplete++;
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo2"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$al[$idComplete].'" class="form-control" id='.$row["campo2id"].' name='.$row["campo2id"].' required></div><br></div></div></div>';
		}
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
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
<!-- </div> -->
  </div>
</div>
