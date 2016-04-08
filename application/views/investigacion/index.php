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
<?php echo form_open('ApoyoDocencia');?>
<div class="row">
<?php
foreach ($ApoyoDocencia as $row) {

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


<div id="participacion" role="tabpanel" aria-labelledby="participacion-tab" class="tab-pane fade">
<?php echo form_open('ParticipacionAlmunnos');?>
<div class="row">
<?php
foreach ($ParticipacionAlmunnos as $row) {

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

      <!-- Termina "myTabContent" -->
      </div>
    </div>
  </div>
</div>



