



<div class="login">


<div class="login-screen">



          <div class="login-icon">
            <img src="/petCloud/includes/Flat-UI-master/images/icons/dog-ico2.png" alt="Welcome to Mail App">
            <h4>Bienvenido<small>petCloud</small></h4>
          </div>






     <?php echo form_open('verifylogin'); ?>


          <div class="login-form">
            <div class="control-group">
              <input type="text" class="login-field" value="" placeholder="Username" id="username" name="username" autofocus>
              <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="control-group">
              <input type="password" class="login-field" value="" placeholder="Password" id="login-pass" id="passowrd" name="password">
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

<input class="btn btn-primary btn-large btn-block" type="submit" value="Iniciar"/>


            <a class="login-link" href="#">¿No recuerda su contraseña?</a>
            <a class="login-link" href="#">Crear una cuenta</a>
          </div>
          <?php echo validation_errors(); ?>
        </div>  

</div>



