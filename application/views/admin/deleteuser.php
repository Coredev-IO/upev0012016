<!-- pinta mi objeto -->
<!-- <?php print_r($usuarios); ?>  -->
<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
        <ul id="myTabs" role="tablist" class="nav nav-tabs">
                <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Eliminar Usuario</a></li>
        </ul>
<?php echo form_open('admin/delete_admin');?>
        <?php
if (count($unidades) > 0) {
	//creas un select
	// print_r($unidades);
} else {
	//NO SE PINTA SELECT
}

$rol_value = "";

switch ($usuarios[0]->idRoles) {
	case 2:
		if ($usuarios[0]->Nivel == "MED") {
			$rol = "newmscap";
		} else {
			$rol = "newsupcap";
		}
		break;
	case 3:
		$rol = "newmscon";
		echo '<input type="hidden" class="form-control" value="7000" name="idUnidad">';
		break;
	case 4:
		$rol = "newsupcon";
		echo '<input type="hidden" class="form-control" value="8000" name="idUnidad">';
		break;
	case 1:
		$rol = "newadmin";
		echo '<input type="hidden" class="form-control" value="9000" name="idUnidad">';
		break;
	default:
		redirect('admin', 'refresh');
}

echo '<input type="hidden" class="form-control" value='.$usuarios[0]->idRoles.' name="idRoles">';
echo '<input type="hidden" class="form-control" value='.$usuarios[0]->idUsuarios.' name="idUsuarios">';
echo '<input type="hidden" class="form-control" value='.$rol.' name="perfil">';


?>
<div class="row">
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Usuario</label>
                                  <input type="text" class="form-control" placeholder="" name="user_name" maxlength="40" value=<?php echo $usuarios[0]->Userdisplay?> required disabled autofocus>
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apPaterno">Nombre</label>
                                  <input type="text" class="form-control"  placeholder="" name="nombre" maxlength="40" value=<?php echo $usuarios[0]->Nombre?> required disabled onkeypress="return val(event)">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Apellido Paterno</label>
                                  <input type="text" class="form-control"  placeholder="" name="apPaterno" maxlength="40" value=<?php echo $usuarios[0]->ApellidoPaterno?> required disabled onkeypress="return val(event)">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Apellido Materno</label>
                                  <input type="text" class="form-control"  placeholder="" name="apMaterno" maxlength="40" value=<?php echo $usuarios[0]->ApellidoMaterno?> required disabled onkeypress="return val(event)">
                          </div>
                  </div>
          </div>
          <div class="row">
<?php
if ($usuarios[0]->idRoles == 2) {
	if (count($unidades) > 0) {
		//creas un select
		echo '<div class="col-md-12">
                            <div class="form-group">
                              <label for="apPaterno">Selecione una unidad</label>';
		echo '<select name ="unidades " class="form-control">
                                    <option>  </option>';
		foreach ($unidades as $row) {
                        if ($row->idUnidad==$usuarios[0]->idUnidad){
                                echo "<option value =".($row->idUnidad)." selected>".($row->NombreUnidad)."</option>";
                        }else{
			                             echo "<option disabled value =".($row->idUnidad).">".($row->NombreUnidad)."</option>";
                                             }
		}
		echo '</select>
                            </div>
                          </div>';

	}
}
?>
<div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Email</label>
                                  <input type="email" class="form-control" placeholder="" name="email" value=<?php echo $usuarios[0]->Email?> required disabled maxlength="80">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Telefono</label>
                                  <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"  placeholder="" name="tel" value=<?php echo $usuarios[0]->Telefono?> required disabled maxlength="10">
                          </div>
                  </div>

                  <!-- <div class="col-md-6">
                          <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" placeholder="" name="pass" required disabled>
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="Confirma_password">Confirma Password</label>
                                  <input type="password" class="form-control" placeholder="" name="pass2" required disabled>
                          </div>
                  </div> -->
<?php
echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Eliminar<div class="ripple-container"></div></button></div>';
echo form_close();
?>
        </div>

      </div>
    </div>
  </div>
</div>
