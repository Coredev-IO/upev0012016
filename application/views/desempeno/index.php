<div class="row">
              <div class="col-md-12">
                <div class="well">
                  <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                      <ul id="myTabs" role="tablist" class="nav nav-tabs">
                        <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Alumnos</a></li>
                        <li role="presentation"><a id="profile-tab" href="#profile" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Perfil Docente</a></li>
                      </ul>
                      <br>
                      <div id="myTabContent" class="tab-content">
                        <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade active in">
<?php echo form_open('desempeno/updateAlumnos');?>
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
$idBloq = 5;

foreach ($nivelAlumnos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                      = 1;
		$varID                                                  = "";
		if ($row["Nombre"] == "Rendimiento") {$varID            = "a";};
		if ($row["Nombre"] == "Eficiencia terminal") {$varID    = "b";};
		if ($row["Nombre"] == "Titulación") {$varID            = "c";};
		if ($row["Nombre"] == "Promoción de NMS a NS") {$varID = "d";};
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
				$valor = $arrsec[$idBloq];
			}
			foreach ($arrsec as $value) {
				// print_r($value[$prinArr2]);
				// echo $value;
				// if ($value[2] == $roww["idBloques"]) {
				// 	$valor = $value[5];
				// }
			}
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.'></div><br></div></div></div>';
			$i = $i+1;

			$prinArr++;
		}

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
	} else {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
	}
	$idBloq++;
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
                        <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade">
<?php echo form_open('desempeno/updateDocencia');?>
<!-- <div class="row"> -->
<?php
foreach ($nivelDocentes as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i                                                                                      = 1;
		$varID                                                                                  = "";
		if ($row["Nombre"] == "Aprovechamiento de la planta docente") {$varID                   = "e";};
		if ($row["Nombre"] == "Docentes de asignatura activos en el sector productivo") {$varID = "f";};
		if ($row["Nombre"] == "Docentes actualizados en el área diciplinar") {$varID           = "g";};
		if ($row["Nombre"] == "Desempeño docente por academia") {$varID                        = "h";};
		$prinArr                                                                                = 0;

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
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="'.$valor.'" class="form-control" id='.$roww["idBloques"].'-'.$varID.'-'.$i.' name='.$roww["idBloques"].'-'.$varID.'-'.$i.'></div><br></div></div></div>';
			$i = $i+1;
			$prinArr++;
		}

		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
	} else {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo2id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
		echo '<div class="divider"></div></div>';
	}
	$idBloq++;
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
                  </div>
                </div>
              </div>
            </div>




