<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
          <ul id="myTabs" role="tablist" class="nav nav-tabs">
            <li role="presentation" class="active"><a id="servicios-tab" href="#servicios" role="tab" data-toggle="tab" aria-controls="servicios" aria-expanded="true">Servicio Social</a></li>
            <li role="presentation"><a id="visitas-tab" href="#visitas" role="tab" data-toggle="tab" aria-controls="visitas" aria-expanded="false">Visitas Escolares</a></li>
            <li role="presentation" class="active"><a id="proyectos-tab" href="#proyectos" role="tab" data-toggle="tab" aria-controls="proyectos" aria-expanded="true">Proyectos Vinculados</a></li>
          </ul>
          <br>
          <div id="myTabContent" class="tab-content">

<div id="servicios" role="tabpanel" aria-labelledby="servicios-tab" class="tab-pane fade active in">
<?php echo form_open('ServicioSocial');?>
<!-- <div class="row"> -->
<?php
foreach ($ServicioSocial as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id=b'.$i.' name=b'.$i.'></div><br></div></div></div>';
			$i = $i+1;
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
}
// echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-raised btn-success">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
<!-- </div> -->
</div>


<div id="visitas" role="tabpanel" aria-labelledby="visitas-tab" class="tab-pane fade">
<?php echo form_open('VisitasEscolares');?>
<!-- <div class="row"> -->
<?php
foreach ($VisitasEscolares as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id=b'.$i.' name=b'.$i.'></div><br></div></div></div>';
			$i = $i+1;
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
}
// echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-raised btn-success">Confirmar</a></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
<!-- </div> -->


<div id="proyectos" role="tabpanel" aria-labelledby="proyectos-tab" class="tab-pane fade">
<?php echo form_open('ProyectosVinculados');?>
<!-- <div class="row"> -->
<?php
foreach ($ProyectosVinculados as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	if ($row["Despegable"]) {
		echo '<div class="row row-bloque">';
		echo '<div class="col-md-4">&nbsp;</div>';
		echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-12 title-row">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"></div><br></div></div></div>';
		$i = 1;
		foreach ($bloques as $roww) {
			echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$roww["Nombre"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id=b'.$i.' name=b'.$i.'></div><br></div></div></div>';
			$i = $i+1;
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
}
// echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo '<div class="col-md-12"><a href="#" name="btn-submit" class="btn btn-raised btn-success">Confirmar</a></div>';
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



