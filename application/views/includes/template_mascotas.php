<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head') ?>

  <body>
        <?php 
        //$data['usuario']=$usuario;
        $this->load->view('includes/menu_mascotas'); 
        $this->load->view($main_cont);
        $this->load->view('includes/footer'); 
        $this->load->view('includes/js'); 
        ?>
  </body>
</html>