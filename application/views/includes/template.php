<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head') ?>

  <body>
        <?php $this->load->view('includes/header'); ?>
        <div class="container">
        <?php 
            $this->load->view($main_cont, $username);
            $this->load->view('includes/footer');
            $this->load->view('includes/js'); 
        ?>
        </div>
  </body>
</html>
