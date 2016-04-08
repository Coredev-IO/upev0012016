<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
        <body>
         <div class="header-ipn">
        	<div class="container">
        		<div class="col-md-6">
					<img src="<?=base_url()?>/principal/img/sep.png" alt="">
        		</div>
        		<div class="col-md-6 right">
					<img src="<?=base_url()?>/principal/img/ipn.png" alt="">
        		</div>
        	</div>
        </div>
        <div class="menu-top">
        <center>Sistema Institucional de Evaluación del Desempeño de Las Unidades Académicas</center>

        </div>


<div class="container cnt-body">



<div class="well page active  col-md-12 menu-res">
      <div class="col-md-6" id="input" style="display: block;">
      <label class="header"><?php echo $datos['Username'].",".$datos['Nombre']." ".$datos['ApellidoPaterno']." ".$datos['ApellidoMaterno']." ".$datos['NombreUnidad']."idUnidad: ".$datos['idUnidad'].", Nivel: ".$datos['Email']?></label>
      </div>
      <div class="col-md-3 col-md-offset-3" id="input" style="display: block;">
      <label class="header"> <?php echo $datos['NombreUnidad']."idUnidad: ".$datos['idUnidad']?></label>
      </div>




</div>


                 <!-- Navbar principal -->
					<div class="bs-component">
					        <div class="navbar navbar-default">
					                <div class="container-fluid">
					                        <div class="navbar-header">
					                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					                                        <span class="icon-bar"></span>
					                                        <span class="icon-bar"></span>
					                                        <span class="icon-bar"></span>
					                                </button>
					                                <a class="navbar-brand" href="javascript:void(0)">UPEV</a>
					                        </div>
					                        <div class="navbar-collapse collapse navbar-responsive-collapse">
					                                <ul class="nav navbar-nav">
					                                </ul>
					                                <ul class="nav navbar-nav navbar-right">
					                                        <li><a href="<?=base_url()?>index.php/logout">SALIR</a></li>
					                                </ul>
					                        </div>
					                </div>
					        </div>
					        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt;
 &gt;
</div>
					</div>


                 		<div id="app">
                 		<div class="">
                 				<div class="row">

<?php
$this->load->view("includes/menuApp");?>
<div class="col-md-9 col-lg-10 col-sm-9">
							                          <nav role="navigation" class="navbar navbar-default">
							                            <div class="container-fluid">
							                              <div class="navbar-header"><a href="#" class="navbar-brand"><i class="fa fa-r fa-certificate"></i>&nbsp;
							                &nbsp;
<?php echo $nivel1['Nombre'];?></a></div>
							                            </div>
							                          </nav>



<?php
$this->load->view($main_cont);
$this->load->view('includes/js');
?>
</div></div></div></div></div>
         </body>
</html>
