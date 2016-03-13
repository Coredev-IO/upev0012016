<!DOCTYPE html>
<html lang="es">
<?php $this->load->view('includes/head')?>
        <body>
                 <div class="container cnt-body">
                        <?php
                                $this->load->view("includes/menu");
                                $this->load->view($main_cont);
                                $this->load->view('includes/js');
                        ?>
                </div>
         </body>
</html>
