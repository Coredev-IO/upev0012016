<div class="row">
              <div class="col-md-12">
                      <div class="well">
                              <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                                      <ul id="myTabs" role="tablist" class="nav nav-tabs">
                                              <li role="presentation" class="active"><a id="home-tab" href="#home" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Usuarios para <b>captura</b> de información de Nivel Superior</a></li>
                                      </ul>
                                      <table id="table-user" class="table table-condensed table-striped">
                                             <thead>
                                                     <tr>
                                                             <th>Nombre</th>
                                                             <th>Username</th>
                                                             <th>Email</th>
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
                                                                       echo '<td><a href="" class="btn btn-default btn-xs">Editar</button></td>';
                                                                       echo "</tr>";

                                                               }
                                                     ?>
                                             </tbody>
                                       </table>
                              </div>


                      </div>
              </div>
</div>
