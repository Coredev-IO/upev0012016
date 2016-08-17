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
$this->load->view("includes/menuConsulta");?>
<div class="col-md-9 col-lg-9 col-sm-9">
<div class="card">
  <div class="card-header">
<?php echo $nivel1['Nombre'];?>
</div>
  <div class="card-block">
    <!-- <h4 class="card-title">Special title treatment</h4>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a> -->



<?php
if (isset($message)) {
	if ($message == "insert") {

		echo '<div class="card card-outline-success text-xs-center">
  <div class="card-block">
    <blockquote class="card-blockquote">
      La información se actualizó correctamente
    </blockquote>
  </div>
</div>';
	}

}?>
<?php

$this->load->view($main_cont);
$this->load->view('includes/js');
?>
</div>

</div>







</div></div></div></div></div>
<script>

        $("input").prop("disabled", true);
        $(".formNoOculto input").prop("disabled", false);
</script>

         </body>
</html>
