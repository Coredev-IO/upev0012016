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

<!-- <div class="card text-xs-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-block">
    <h4 class="card-title">Special title treatment</h4>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div> -->
