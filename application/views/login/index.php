<?php echo form_open('verifylogin');?>
<div class="row">
        <div class="col-md-6 col-md-offset-3">
                <div class="well">
                        <div class="form-group label-floating is-empty">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                                <span class="help-block">Usuario proporcionado por la UPEV </span>
                        </div>
                        <div class="form-group label-floating is-empty">
                                <label for="password" class="control-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="help-block">Si olvido la contraseña contacte al administrador</span>
                        </div>
                        <hr>
                        <button type="submit" name="btn-submit" class="btn btn-raised btn-success">Iniciar<div class="ripple-container"></div></button>
                        <hr>
                         <a class="login-link" href="#">¿No recuerda su contraseña?</a>
                         <?php
                                echo form_close();
                                echo "<hr><div class='errors'>";
                                echo validation_errors();
                                echo "</div>";
                         ?>
                </div>
        </div>
</div>
