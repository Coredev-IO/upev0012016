<div class="col-md-5">
<span class="card-title">Usuarios <b>Administradores</b></span>
</div>
<div class="col-md-3 offset-md-4">
<a class="btn btn-outline-success btn-sm btn-100" href="<?=base_url()?>index.php/admin/user_reg/newadmin">Agregar Usuario</a>
</div>
<div class="spacew"></div>



       <table id="table-user" class="table table-sm table-hover table-striped">
          <thead class="thead-inverse">
            <tr>
              <th>Nombre</th>
              <th>Username</th>
              <th>Email</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($usuarios as $row) {
	echo "<tr>";
	echo "<td>".($row->ApellidoPaterno)." ".($row->ApellidoMaterno)." ".($row->Nombre)."</td>";
	echo "<td>".($row->Userdisplay)."</td>";
	echo "<td>".($row->Email)."</td>";
	echo '<td><a href="'.base_url().'index.php/admin/showUser/'.$row->idUsuarios.'" class="btn btn-outline-success btn-sm btn-100">Editar</button></td>';
	echo '<td><a href="'.base_url().'index.php/admin/deleteuser/'.$row->idUsuarios.'" class="btn btn-outline-warning btn-sm btn-100">Borrar</button></td>';
	echo "</tr>";

}
?>
          </tbody>
        </table>
<div class="spacew"></div>