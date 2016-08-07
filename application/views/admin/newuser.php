<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
        <ul id="myTabs" role="tablist" class="nav nav-tabs">
                <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo $plantilla; ?></a></li>
        </ul>
        <?php echo form_open('admin/insert_admin');?>
        <?php
                if(count($unidades)>0){
                        //creas un select
                        // print_r($unidades);
                }else{
                        //NO SE PINTA SELECT
                }

                $rol_value = "";

                switch ($rol) {
                        case "newmscap":
                                $rol_value = 2;
                                break;
                        case "newsupcap":
                                $rol_value = 2;
                                break;
                        case "newmscon":
                                $rol_value = 3;
                                echo '<input type="hidden" class="form-control" value="7000" name="idUnidad">';
                                break;
                        case "newsupcon":
                                $rol_value= 4;
                                echo '<input type="hidden" class="form-control" value="8000" name="idUnidad">';
                                break;
                        case "newadmin":
                                $rol_value = 1;
                                echo '<input type="hidden" class="form-control" value="9000" name="idUnidad">';
                                break;
                        default:
                                redirect('admin', 'refresh');
                }



                echo '<input type="hidden" class="form-control" value='.$rol_value.' name="idRoles">';


        ?>
          <div class="row">
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Usuario</label>
                                  <input type="text" class="form-control" placeholder="" name="user_name">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apPaterno">Nombre</label>
                                  <input type="text" class="form-control"  placeholder="" name="nombre" autofocus>
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Apellido Paterno</label>
                                  <input type="text" class="form-control"  placeholder="" name="apPaterno">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Apellido Materno</label>
                                  <input type="text" class="form-control"  placeholder="" name="apMaterno">
                          </div>
                  </div>
          </div>
          <div class="row">
                  <?php
                  if(count($unidades)>0){
                  //creas un select
                  echo '<div class="col-md-12">
                          <div class="form-group">
                            <label for="apPaterno">Selecione una unidad</label>';
                            echo '<select name ="unidades " class="form-control"> 
                                  <option>  </option>';
                             foreach ($unidades as $row) {
                              echo "<option value =".($row->idUnidad).">".($row->NombreUnidad)."</option>";
                             }
                        echo '</select>
                          </div>
                        </div>';

                  }
                ?>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Email</label>
                                  <input type="text" class="form-control" placeholder="" name="email">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Telefono</label>
                                  <input type="text" class="form-control"  placeholder="" name="tel">
                          </div>
                  </div>

                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Password</label>
                                  <input type="password" class="form-control" placeholder="" name="pass">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Confirma Password</label>
                                  <input type="password" class="form-control" placeholder="" name="pass2">
                          </div>
                  </div>
          </div>

        <?php
        echo '<div class="col-md-12"><button type="submit" name="btn-submit" class="btn btn-raised btn-success">Confirmar<div class="ripple-container"></div></button></div>';
        echo form_close();
        ?>


      </div>
    </div>
  </div>
</div>
