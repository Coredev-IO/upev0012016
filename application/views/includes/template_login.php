<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
<body>
<?php $this->load->view(('includes/header-ipn'))?>
        <?php $this->load->view('includes/menu-topw')?>
<!--        <div class="menu-cont">

       <div class="container">
        	<div class="menu-op">

        	</div></div>

        </div> -->
                 <div class="container cnt-body">
<?php
$this->load->view($main_cont);
$this->load->view('includes/js');
?>
</div>
         </body>
</html>
