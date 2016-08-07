<h1>Usuario agregado</h1>

<?php

        print_r($form);

        echo $form['perfil'];
        echo "<br>";


 ?>



<?php
echo form_open('admin/finalizar');
echo '<input type="hidden" value='.$form['perfil'].' name="perfil">';

echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
echo form_close();
?>
