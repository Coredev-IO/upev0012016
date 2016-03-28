<?php echo form_open('nuevaevaluacion/crear');?>
<div class="row">
        <div class="col-md-12">
                <div class="well">
                        <div class="form-group label-floating is-empty">
                                <label for="Nombre" class="control-label">NOMBRE</label>
                                <input type="text" class="form-control" id="Nombre" name="Nombre">
                                <span class="help-block">LOREM </span>
                        </div>
                        <div class="form-group label-floating is-empty">
                                <label for="Descripcion" class="control-label">Descripción</label>
                                <input type="text" class="form-control" id="Descripcion" name="Descripcion" value="">
                                <span class="help-block">HELP</span>
                        </div>
                        <br>
                        <button type="submit" name="btn-submit" class="btn btn-raised btn-success">Continuar<div class="ripple-container"></div></button>
                        <a href="<?=base_url()?>index.php/home" name="btn-submit" class="btn btn-raised btn-danger">Cancelar<div class="ripple-container"></div></a>
<?php
echo form_close();
echo "<hr><div class='errors'>";
echo validation_errors();
echo "</div>";
?>
</div>
</div>
</div>
