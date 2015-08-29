<?php $this->load->helper('form'); ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper('html'); ?>
<!DOCTYPE html>
<html lang="es">
<head>

    <title><?php echo $title; ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="author" content=""/>
    <meta name="contact" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1"/>

    <!-- Estilos -->
    <?php echo link_tag('assets/css/normalize.css'); ?>
    <?php echo link_tag('assets/css/style.css'); ?>
    <?php echo link_tag('assets/css/jquery-ui.css'); ?>

</head>
<body data-url="<?php echo base_url() ?>">

<?php
if ( $this->session->userdata('is_logued_in') ): ?>
    <div class="bar-admin"><a href="<?php echo base_url() . "login/logout" ?>">Cerrar Sesión</a></div>
<?php endif; ?>

<figure class="logo">
    <?php echo img(array('src' => 'assets/images/logo.png')) ?>
</figure>


<?php $this->load->view($view); ?>

<!-- JavaScript -->

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>



</body>
</html>