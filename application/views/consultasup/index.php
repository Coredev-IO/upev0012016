<?php echo form_open('consultasup/check');?>
<div class="row">
        <div class="col-md-6 offset-md-3">
                <?php
                	//creas un select
                	echo '<div class="form-group">
                                            <label for="apPaterno">Selecione una unidad</label>';
                	echo '<select name ="idUnidad" class="form-control">';
                	echo "<option value =''>Seleccione una unidad ...</option>";
                	foreach ($unidades as $row) {
                		echo "<option value =".($row->idUnidad).">".($row->NombreUnidad)."</option>";
                	}
                	echo '</select>
                                          </div>';



                ?>
        </div>
        </div>
<div class="row">
        <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-outline-info btn-100">CONSULTAR</button>
        </div>

</div>
<br>
<?php
echo form_close();
?>

<div class="card text-xs-center">
  <div class="card-header">
    ESTATUS GENERAL DE EVALUACIONES
  </div>
  <div class="card-block">
    
  </div>
  <div class="card-footer text-muted">
    NO SE PUEDE GENERAR UN REPORTE GENERAL POR QUE NO SE HA CONCLUIDO EL PROCESO DE REVISIÓN PARA TODAS LAS UNIDADES
  </div>
</div>
