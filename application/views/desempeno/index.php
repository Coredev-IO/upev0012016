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
<?php echo form_open('alumnos');?>
<div class="row">
<?php
foreach ($nivelAlumnos as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
	echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
	echo '<div class="divider"></div>';
}
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
                        </div>
                        <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade">
<?php echo form_open('docentes');?>
<div class="row">
<?php
foreach ($nivelDocentes as $row) {

	// echo '<div class="col-md-4">'.$row["Nombre"].' '.$row["Valor"].'%</div>';
	// echo '<div class="col-md-4">'.$row["Indicadores"].'</div>';
	// echo '<div class="col-md-4">'.$row["Descripcion"].'</div>';
	echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo1"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
	echo '<div class="col-md-12"><div class="row inputs-form"><div class="col-md-10">'.$row["campo2"].'</div><div class="col-md-1"><div class="form-group label-floating is-empty"><input type="text" value="0" class="form-control" id='.$row["campo1id"].' name='.$row["campo1id"].'></div><br></div></div></div>';
	echo '<div class="divider"></div>';
}
echo '<button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button>';
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
                      </div>
                  </div>
                </div>
              </div>
            </div>




