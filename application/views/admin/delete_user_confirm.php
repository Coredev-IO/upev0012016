<div class="card">
  <div class="card-header">
    Usuario Eliminado
  </div>
   <ul class="list-group list-group-flush">
    <li class="list-group-item">El usuario se elimino correctamente</li>
  </ul>



    <div class="card-footer">
<?php
echo form_open('admin/finalizar');
echo '<input type="hidden" value='.$form['perfil'].' name="perfil">';

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-outline-success">Inicio<div class="ripple-container"></div></button></div>';
echo form_close();
?>
</div>
</div>

