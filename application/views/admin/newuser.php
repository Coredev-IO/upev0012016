<div class="row">
  <div class="col-md-12">
    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
        <ul id="myTabs" role="tablist" class="nav nav-tabs">
                <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo $plantilla; ?></a></li>
        </ul>
        <?php echo form_open_multipart('admin/insert_admin');?>
          <div class="row">
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apPaterno">Apellido Paterno</label>
                                  <input type="text" class="form-control"  placeholder="" name="apPaterno" autofocus>
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Apellido Materno</label>
                                  <input type="text" class="form-control" placeholder="" name="apMaterno">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Nombre(s)</label>
                                  <input type="text" class="form-control"  placeholder="" name="nombre">
                          </div>
                  </div>
          </div>
          <hr>
          <div class="row">
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apPaterno">Selecione una unidad</label>
                                  <input type="text" class="form-control"  placeholder="" name="apPaterno" autofocus>
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="apMaterno">Username</label>
                                  <input type="text" class="form-control" placeholder="" name="user_name">
                          </div>
                  </div>
                  <div class="col-md-6">
                          <div class="form-group">
                                  <label for="nombre">Nombre(s)</label>
                                  <input type="text" class="form-control"  placeholder="" name="nombre">
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

<!-- 43#09dr9M7 -->
