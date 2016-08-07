<h1>Usuario agregado</h1>
<div class="well">
  <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
  

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
		  <h4>Nombre Completo</h4>
			<?php echo '<label value ='.$form['Nombre'].'>'.$form['Nombre'].' '.$form['ApellidoPaterno'].' '.$form['ApellidoMaterno'].'</label>'; ?>
		</div>
		<div class="col-md-12">
		  <h4>Nombre de Usuario</h4>
			<?php echo '<label value ='.$form['Userdisplay'].'>'.$form['Userdisplay'].'</label>'; ?>
		</div>
		<div class="col-md-12">
		  <h4>Email</h4>
			<?php echo '<label value ='.$form['Email'].'>'.$form['Email'].'</label>'; ?>
		</div>
		<div class="col-md-12">
		  <h4>Telefono</h4>
			<?php echo '<label value ='.$form['Telefono'].'>'.$form['Telefono'].'</label>'; ?>
		</div>
	</div>
  </div>
</div>



<?php
echo form_open('admin/finalizar');
echo '<input type="hidden" value='.$form['perfil'].' name="perfil">';

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
?>
