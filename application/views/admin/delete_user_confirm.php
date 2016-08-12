<div class="well">
  <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
  <h1>Usuario Eliminado</h1>
  

<?php
// Imprime todo el objeto form
// print_r($form);

// echo $form['perfil'];
// echo $form ['Nombre'];
// echo $form ['ApellidoPaterno'];
// echo $form ['ApellidoMaterno'];
// echo $form ['Userdisplay'];
// echo $form ['Email'];
// echo $form ['Telefono'];
// echo "<br>";
?>
		<div class ="row">
 		<div class="col-md-12">
		</div>
<?php
echo form_open('admin/finalizar');
echo '<input type="hidden" value='.$form['perfil'].' name="perfil">';

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Inicio<div class="ripple-container"></div></button></div>';
echo form_close();
?>
	</div>
  </div>
</div>