<div class="row">
  <div class="col-md-12">
    <div class="well" id="actionbtn">
            <a class="btn btn-default" href="<?=base_url()?>index.php/admin/user_reg/newadmin">Agregar Usuario</a>
    </div>

    <div class="well">
      <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
          <ul id="myTabs" role="tablist" class="nav nav-tabs">
                  <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Usuarios <b>Administradores</b></a></li>
          </ul>
       <table id="table-user" class="table table-condensed table-striped">
          <thead>
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
                      echo '<td><a href="'.base_url().'index.php/admin/showUser/'.$row->idUsuarios.'" class="btn btn-default btn-xs">Editar</button></td>';
                      echo '<td><a href="'.base_url().'index.php/admin/deleteuser/'.$row->idUsuarios.'" class="btn btn-default btn-xs">Borrar</button></td>';
                      echo "</tr>";

              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
