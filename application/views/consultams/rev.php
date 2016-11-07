<div class="row">
        <div class="col-md-8">
<?php
echo "<label>".$unidad[0]->NombreUnidad."</label>";
?>
</div><div class="col-md-4"><a href="<?=base_url()?>/index.php/consultams" class="btn btn-outline-info btn-100">REGRESAR</a></div>
</div>
<hr>
<?php
if(count($evaluaciones)>0){
        foreach ($evaluaciones as $row) {
                echo '<div class="col-md-4"><div class="card text-xs-center">
                          <div class="card-header">
                            '.($row->CreateDate).'
                          </div>
                          <div class="card-block"><p class="card-text">';

                          switch ($row->estado) {
                                  case "ACT":
                                          echo "Proceso de captura";
                                          break;
                                  case "REV":
                                          echo "Activa para revisión";
                                          break;
                                  case "FIN":
                                          echo "Finalizada, generar resultados";
                                          break;
                                  case "RES":
                                          echo "Revisar resultados";
                                          break;
                                  case "CAN":
                                          echo "La evaluación ha sido cancelada";
                                          break;
                                  default:
                                          echo "ERROR";
                                          break;



                          }


                echo '</p>';
                switch ($row->estado) {
                        case "ACT":
                                echo '<a href="" class="btn btn-outline-primary disabled">Sin acciones</a>';
                                break;
                        case "REV":
                                echo '<a href="'.base_url().'index.php/consultams/consulta1/'.$unidad[0]->idUnidad.'/'.$row->idEvaluacion.'" class="btn btn-outline-info">Seguir revisión</a>';
                                break;
                        case "FIN":
                                echo '<a href="'.base_url().'index.php/consultams/calculo/'.$row->idEvaluacion.'" class="btn btn-outline-warning">Revisar resultados</a>';
                                break;
                        case "RES":
                                echo '<a href="#" class="btn btn-outline-success">Ver detalle</a>';
                                break;
                        case "CAN":
                                echo '<a href="#" class="btn btn-outline-danger disabled">Sin acciones</a>';
                                break;
                        default:
                                echo "ERROR";
                                break;



                }



                          echo '</div>
                          <div class="card-footer text-muted">';
                          switch ($row->estado) {
                                  case "ACT":
                                          echo "EN CURSO";
                                          break;
                                  case "REV":
                                          echo "EN REVISIÓN";
                                          break;
                                  case "FIN":
                                          echo "FINALIZANDO";
                                          break;
                                  case "RES":
                                          echo "RESULTADOS PUBLICADOS";
                                          break;
                                  case "CAN":
                                          echo "CANCELADA";
                                          break;
                                  default:
                                          echo "ERROR";
                                          break;



                          }
                echo  '</div>
                        </div></div>';
        }
}else{
                echo "Esta Unidad no tiene evaluaciones";
}


 ?>
