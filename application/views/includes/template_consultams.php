<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
<body>
<?php $this->load->view(('includes/loader'))?>
<?php $this->load->view(('includes/header-ipn'))?>
        <?php $this->load->view('includes/menu-top')?>
<div class="container cnt-body">



<?php $this->load->view(('includes/salir'))?>
<div id="app">
                 		<div class="">
                 				<div class="row">

<?php
$this->load->view("includes/menuMs");?>
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
