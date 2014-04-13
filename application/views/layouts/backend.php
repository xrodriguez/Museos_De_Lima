<!DOCTYPE html>
<html lang="en">
	<head>
        <title><?php echo $this->layout->getTitle(); ?></title>
        <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
        <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/fullcalendar.css" />	
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/datepicker.css" /><!--WZ  -->	
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/unicorn.main.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/unicorn.grey.css" class="skin-color" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/select2.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/style_wz.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/uniform.css" />
   
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/timepicker.css" /><!--WZ  -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="<?php echo base_url()?>public/backend/js/jquery-1.7.min.js" type="text/javascript"></script> <!--WZ  -->
        <script src="<?php echo base_url()?>public/backend/js/jquery.preimage.js"></script>
        <script src="<?php echo base_url()?>ckeditor/ckeditor.js"></script>
        <!--<script type="text/javascript" src="http://barcode-coder.com/js/jquery-barcode-last.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url()?>public/backend/js/jquery-barcode-last.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--<script>
            $(document).ready(function()
            {
                    $('.archivo').preimage();
            });
        </script>
        -->
    <style>
        .prev_container{
                overflow: auto;
                width: 300px;
                height: 135px;
        }

        .prev_thumb{
                margin: 10px;
                height: 100px;
                width: 100px;
        }
    </style>
    <script>
        function soloLetras(e)
        {
           key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           letras = "123456789";
           especiales = [8,37,39,46];

           tecla_especial = false
           for(var i in especiales){
                        if(key == especiales[i]){
                                tecla_especial = true;
                                break;
                        }
                }

                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                        return false;
                }
        }
    </script>
    </head>
	<body>
	<div id="header">
			<h1><a href="./dashboard.html">Unicorn Admin</a></h1>		
		</div>
		<div id="user-nav" class="navbar navbar-inverse">
                    <ul class="nav btn-group">
                        <li class="btn btn-inverse"><a href="<?php echo base_url()?>backend/login/logout"><i class="icon icon-share-alt"></i> <span class="text">Cerrar Sesión</span></a></li>
                    </ul>
                </div>
               
		<div id="sidebar">
			<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
			<ul>
				<li <?php if($this->uri->segment(3)=="backend") echo ' class="active"' ?>>
                                    <a href="<?php echo site_url(); ?>backend"><i class="icon icon-home"></i> <span>Cpanel Admin</span></a>
                                </li>
				
                                <li class="submenu <?php if(
                                        $this->uri->segment(3)=="listar_museos"
                                        or $this->uri->segment(3)=="edit_museo" 
                                        or $this->uri->segment(3)=="add_museo" 
                                        or $this->uri->segment(3)=="listar_categorias" 
                                        ) echo 'open' ?>">
                                    <a href="#"><i class="icon icon-th-list"></i> <span>Mantenimiento</span></a>
                                    <ul>
                                        
                                        <li <?php if($this->uri->segment(3)=="listar_distritos" or $this->uri->segment(3)=="edit_multa") echo ' class="active"' ?>>
                                            
                                        </li>
                                        <li <?php if($this->uri->segment(3)=="listar_museos" 
                                                or $this->uri->segment(3)=="edit_museo" 
                                                or $this->uri->segment(3)=="add_museo" 
                                                or $this->uri->segment(3)=="edit_museo"
                                                or $this->uri->segment(3)=="listar_categorias"
                                                ) echo ' class="active"' ?>>
                                            <a href="<?php echo site_url(); ?>backend/index/listar_museos">Museos</a>
                                            <a href="<?php echo site_url(); ?>backend/index/listar_categorias">Categorias</a>
                                        </li>
                                    </ul>
				</li>
				
			</ul>
		
		</div>	
		<div id="content">
			<div id="content-header">
				<h1><?php echo $this->layout->getSubTitle(); ?></h1>
			</div>
			<div id="breadcrumb">
				<a href="<?php echo site_url(); ?>backend/" title="Inicio" class="tip-bottom"><i class="icon-home"></i> Cpanel</a>
				<?php echo $this->layout->getBreadcrumb(); ?>
			</div>
			<div class="container-fluid">
            	<?php echo $content_for_layout; ?>
				<div class="row-fluid">
					<div id="footer" class="span12">
						2014 &copy; Yaqua. Desarrollador por <a href="http://alive.pe">Alive</a>
					</div>
				</div>
			</div>
		</div>                  
<!--
<script src="<?php echo base_url()?>public/backend/js/excanvas.min.js"></script>
-->
<script src="<?php echo base_url()?>public/backend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url()?>public/backend/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>public/backend/js/jquery.uniform.js"></script>
<script src="<?php echo base_url()?>public/backend/js/select2.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>public/backend/js/unicorn.js"></script>
<script src="<?php echo base_url()?>public/backend/js/unicorn.form_common.js"></script>
<script src="<?php echo base_url()?>public/backend/js/eventos.js"></script>
<script src="<?php echo base_url()?>public/backend/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/unicorn.tables.js"></script>

<!--
<script src="<?php echo base_url()?>public/backend/js/js/jquery.flot.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/js/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/jquery.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/jquery.peity.min.js"></script>
<script src="<?php echo base_url()?>public/backend/js/unicorn.dashboard.js"></script>-->

<script src="<?php echo base_url()?>public/backend/js/unicorn.form_validation.js"></script>
<script src="<?php echo base_url()?>public/backend/js/jquery.validate.js"></script>
<script src="<?php echo base_url()?>public/backend/js/wz_script.js"></script> <!--WZ  -->


<script src="<?php echo base_url()?>public/backend/js/bootstrap-timepicker.js"></script> <!--WZ  -->
<script src="<?php echo base_url()?>public/backend/js/form-components.js"></script> <!--WZ  -->
 <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         FormComponents.init();
      });
   </script> 
</body>
</html>