<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/headApp') ?>

  <body>
        <?php 
        $this->load->view('includes/menu_mascotas'); 
        $this->load->view($main_cont);
        $this->load->view('includes/footer2'); 
        $this->load->view('includes/js'); 
        ?>
  </body>
</html>