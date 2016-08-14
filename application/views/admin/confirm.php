<div class="card">
  <div class="card-header">
    Usuario agregado
  </div>
   <ul class="list-group list-group-flush">
    <li class="list-group-item">Nombre Completo:<b>
<?php echo '<label value ='.$form['Nombre'].'>'.$form['Nombre'].' '.$form['ApellidoPaterno'].' '.$form['ApellidoMaterno'].'</label>';?></b></li>
    <li class="list-group-item">Nombre de Usuario: <b><?php echo '<label value ='.$form['Userdisplay'].'>'.$form['Userdisplay'].'</label>';?></b></li>
    <li class="list-group-item">Email: <b><?php echo '<label value ='.$form['Email'].'>'.$form['Email'].'</label>';?></b></li>
    <li class="list-group-item">Telefono: <b><?php echo '<label value ='.$form['Telefono'].'>'.$form['Telefono'].'</label>';?></b></li>
  </ul>



    <div class="card-footer">
<?php
echo form_open('admin/finalizar');
echo '<input type="hidden" value='.$form['perfil'].' name="perfil">';

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
?>
</div>
</div>
