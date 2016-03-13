<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
    #info_subida{
        width: 350px;
        padding: 20px;
        background-color: #A70000;
        color: #fff;
        font-weight: bold;
    }
    ul{
        list-style: none;
        padding: 20px;
    }
    a{
        padding: 10px;
        background: #222;
        color: #fff;
        text-decoration: none;
    }
    #imagenes{
        float: right;
        position: absolute;
        margin: -525px 0px 0px 450px;
    }
</style>
</head>
<body>
<!--mostramos la información de la imagen-->
<h3>Tu imagen fué subida correctamente!</h3>
<div id="info_subida">
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
</div>
<p><?php echo anchor('upload', 'Sigue subiendo archivos!!'); ?></p>
<!--mostramos la imagen subida-->
<div id="imagenes">
    <h3><?=$titulo?></h3>
    <img src="<?=base_url()?>uploads/thumbs/<?=$imagen?>" />
</div>
</body>
</html>