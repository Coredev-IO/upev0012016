<?php echo form_open('verifylogin');?>
<div class="row">
        <div class="col-md-6 col-md-offset-3">
                <div class="well">
                        <div class="form-group label-floating is-empty">
                                <label for="username" class="control-label">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" autofocus="true">
                                <span class="help-block">Usuario proporcionado por la UPEV </span>
                        </div>
                        <div class="form-group label-floating is-empty">
                                <label for="password" class="control-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="help-block">Si olvido la contraseña contacte al administrador</span>
                        </div>
                        <button type="submit" name="btn-submit" class="btn btn-raised btn-success">Iniciar<div class="ripple-container"></div></button>
                        <br>

                         <!-- <a class="login-link s-top" href="#">¿No recuerda su contraseña?</a> -->
<?php
echo form_close();
echo "<br><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
        </div>
</div>
