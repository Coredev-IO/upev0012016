<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" href="#becas" role="tab" data-toggle="tab">Becas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#tutorias" role="tab" data-toggle="tab">Tutorías</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#servap" role="tab" data-toggle="tab">Servicio de apoyo educativo</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="becas">
<?php echo form_open_multipart('apoyo/update_Becas');?>
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
$idBloq     = 25;
$idComplete = 2;
$v1         = $BecasArr[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 4;

$fileInput = 1;

foreach ($Becas as $row) {

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
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$roww["Nombre"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.'></div><br></div></div></div>';
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

        <input type="hidden" name="redirect" value="consultams/consulta3/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="tabla" value="Becas">
        <input type="hidden" name="comentario" value="cn5">
        <input type="hidden" name="idEvaluacion" value="<?=$datos['idEvaluacion']?>">
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
</div>
  <!-- **************************************************************************************************************** -->

  <div role="tabpanel" class="tab-pane fade" id="tutorias">
<?php echo form_open_multipart('apoyo/update_Tutorias');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $Tutorias[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}
$NumeroArchivo = 4;

$fileInput = 1;

foreach ($Tutoria as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                 = 1;
		$varID                                             = "";
		if ($row["Nombre"] == "Alumnos Tutorados") {$varID = "a"; $varID2 = "z";};
		$prinArr                                           = 0;

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
		$idComplete++;
		echo '<div class="divider"></div></div>';
		$idBloq++;
		$idBloq++;
	} else {
		echo '<div class="row row-bloque">';

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-9">'.$row["campo1"].'</div><div class="col-md-3"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].' required></div><br></div></div></div>';
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

        <input type="hidden" name="redirect" value="consultams/consulta3/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="tabla" value="Tutorias">
        <input type="hidden" name="comentario" value="cn6">
        <input type="hidden" name="idEvaluacion" value="<?=$datos['idEvaluacion']?>">
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

  <div role="tabpanel" class="tab-pane fade" id="servap">
<?php echo form_open_multipart('apoyo/update_ServicioApoyo');?>
<!-- <div class="row"> -->
<?php
$idComplete = 2;
$v1         = $Servicios[0];
$al         = array();
foreach ($v1 as $key) {
	array_push($al, $key);
}

$NumeroArchivo = 12;

$fileInput = 1;

foreach ($ServicioApoyo as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12 title-principal">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-6 title-row"></div><div class="col-md-3 title-row">'.$row["campo1"].'</div><div class="col-md-3 title-row">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';

		$i                                                                 = 1;
		$varID                                                             = "";
		if ($row["Indicadores"] == "Títulos Actualizados") {$varID        = "b"; $varID2        = "y";};
		if ($row["Indicadores"] == "Número de libros por alumno") {$varID = "c"; $varID2 = "x";};
		$prinArr                                                           = 0;

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
		$idComplete++;
		echo '<div class="divider"></div></div>';
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
// echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar<div class="ripple-container"></div></button></div>';
// echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-outline-success btn-100">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
?>
<?php echo form_open('consultams/updatecomentario');
?>

        <div class="formNoOculto">

        <input type="hidden" name="redirect" value="consultams/consulta3/<?=$datos['idUnidad']?>/<?=$datos['idEvaluacion']?>">
        <input type="hidden" name="tabla" value="ApoyoEducativo">
        <input type="hidden" name="comentario" value="cn7">
        <input type="hidden" name="idEvaluacion" value="<?=$datos['idEvaluacion']?>">
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
