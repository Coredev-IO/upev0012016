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


<div class="col-md-12">

        <div class="card">
          <div class="card-header">
            Revisón de Evaluaciones Nivel Medio Superior
          </div>
          <div class="card-block">
            <!-- <h4 class="card-title">Special title treatment</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> -->



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
        </div>

        </div>



</div></div></div></div></div>
         </body>
</html>
