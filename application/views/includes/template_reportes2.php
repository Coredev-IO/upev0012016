<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
<style>
  body{
    background: #fff;
  }
  .header-title{
    font-size: 11px;
  }
  .well{
    padding: 5px;
  }
</style>
<body>
          	<div class="container-fluid">
          		<div class="col-xs-12">
                <center>
                  <img src="<?=base_url()?>/principal/img/header-ipn.png" alt="">
              </center>
          		</div>
          	</div>

            <div class="menu-top">
                    <center></center>

                    </div>
                    <div class="container">
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="well header-title">
                    		<div class="row"><div class="col-md-8 offset-md-2">Sistema Institucional para Evaluar el Desempeño de los Procesos Educativos, Administrativos y de Servicios de la Oferta Educativa</div></div>

                    		</div>
                    	</div>
                    </div>
                    </div>




<div class="container-fluid cnt-body">



<div id="app">
                 		<div class="">
                 				<div class="row">


<div class="col-md-12">


            <!-- <h4 class="card-title">Special title treatment</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> -->




        <?php

        $this->load->view($main_cont);
        $this->load->view('includes/js');
        ?>





</div></div></div></div></div>
         </body>
</html>
