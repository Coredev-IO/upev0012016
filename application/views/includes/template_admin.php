<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
<body>
<?php $this->load->view(('includes/header-ipn'))?>
        <?php $this->load->view('includes/menu-top')?>


<div class="container cnt-body">



<div class="well page active  col-md-12 menu-res">
      <div class="col-md-12" id="input" style="display: block;">
      <label class="header"><?php echo "USUARIO: ".strtoupper($datos['Userdisplay'])."<br>UNIDAD: ".$datos['NombreUnidad']."<br>CORREO: ".$datos['Email']?></label>
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
					                                <!-- <a class="navbar-brand" href="javascript:void(0)">UPEV</a> -->
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
$this->load->view("includes/menuAdmin");?>
<div class="col-md-9 col-lg-9 col-sm-9">
							                          <nav role="navigation" class="navbar navbar-default">
							                            <div class="container-fluid">
							                              <div class="navbar-header"><a href="#" class="navbar-brand"><i class="fa fa-r fa-certificate"></i>&nbsp;
							                &nbsp;

Administración</a></div>
							                            </div>
							                          </nav>


<?php
if (isset($message)) {
	if ($message == "insert") {
		echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>La información se actualizó correctamente</div>';
	}

}?>
<?php

$this->load->view($main_cont);
$this->load->view('includes/js');
?>
</div></div></div></div></div>
         </body>
</html>
