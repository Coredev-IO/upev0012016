<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head') ?>

  <body>
  <div class="container">
        <?php 
        $this->load->view($main_cont);
        $this->load->view('includes/js'); 
        ?>
  </div>
  </body>
</html>
