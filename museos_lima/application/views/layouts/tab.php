<DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->layout->getTitle(); ?></title>
    <meta charset="utf-8">  
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>public/frontend/css/style.css">
   
    <script language="javascript" type="text/javascript" src="<?php echo base_url()?>public/frontend/js/jquery-1.8.3.min.js"></script>
    
    <!-- <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>  -->
    
   
</head>
<body>
    <form enctype="multipart/form-data" method="post">
        
	<div class="contenedor">
            <div>
                <img alt="YAQUA" src="<?php echo base_url()?>public/frontend/images/logo.png">
            </DIV>
            <div class="btn_busqueda">
                <p>Distrito : </p>
                <select name="distrito" id="distrito" >
                    <?php
                        foreach($distritos as $row)
                        {
                        ?>
                        <option value="<?php echo $row->id_distrito ?>" <?php if($row->id_distrito==$id){ echo 'selected="selected"';}?>> <?php echo $row->dis_descripcion ?></option>
                        <?php
                        }
                        ?>
                </select>
                <input class="" type="submit" value="Consultar">
            </div>
            <div class="div_mapa">
                <?php if($id ==""){ $id=1;}
                      foreach($distritos as $row)
                      { ?>
                <?php 
                        if($row->id_distrito == $id)
                        {   $vieja = 'width="425" height="350"';
                        $nueva = 'width="700" height="600"';
                        $url_mapa =str_replace($vieja , $nueva , $row->dis_mapa);
                        echo htmlspecialchars_decode($url_mapa); 
                        } ?>
                   <?php } 
                      
                     ?>
            </DIV>
                
            <!-- <img src="<?php echo base_url()?>public/frontend/images/slider/slide.jpg" alt="" />-->
                   
       </div>
    </form>    

</body>
</html>