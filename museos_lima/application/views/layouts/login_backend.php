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
        <link rel="stylesheet" href="<?php echo base_url()?>public/backend/css/unicorn.login.css" />
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
	<body>
	
		<?php echo $content_for_layout; ?>
		<script src="<?php echo base_url()?>public/backend/js/jquery.min.js"></script>  
        <script src="<?php echo base_url()?>public/backend/js/unicorn.login.js"></script>
	</body>
</html>