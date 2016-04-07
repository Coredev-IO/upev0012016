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
        <div class="menu-cont">

       <div class="container">
        	<div class="menu-op">

        	</div></div>

        </div>
                 <div class="container cnt-body">
<?php
$this->load->view($main_cont);
$this->load->view('includes/js');
?>
</div>
         </body>
</html>
