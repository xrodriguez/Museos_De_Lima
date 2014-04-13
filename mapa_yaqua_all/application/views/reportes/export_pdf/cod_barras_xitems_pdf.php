<?php //var_dump($producto); ?>
<?php //var_dump($det_producto); ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
	<meta charset="utf-8">
	<title>Codigo de barras</title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>public/frontend/css/style_wz.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>public/backend/js/jquery-barcode-last.min.js"></script>
</head>
<body>
    <div class="cabecera_impri_codbarras">	
     <h2 class="cabecera_docimprimir margin5">Juego : <?php echo trim($producto[0]->nombre); ?>  <br> Consola : <?php echo trim($producto[0]->plat_descripcion); ?>  </h2> 
        <div class="logo_imprimir logo_en_codbarras"><img src="<?php echo base_url()?>public/frontend/images/logo.png" ></div>
       <!-- <HR width=100% > -->
    </div>
           <table border="0"> 
           <?php $i=0;
           $columna=1;
           $fila=1;
           $maxcolumna=4;
           foreach ($det_producto as $row) { 
               if($columna==1)
                { echo "<tr style='margin-top:10px;'>"; }    
               if($columna < $maxcolumna)
               {  
                ?>
               <td> 
               <div class="lista_prod_x_cod">
                 
                   <p class="cod_barras_x_prod_estado">Estado : <?php echo strtoupper($row->estado);  ?> </p>
                 <div class="cod_barras_x_prod">
                    <!--
                        <script>
                        $(document).ready(function(){
                        $("#bcTarget_<?php echo $row->cod_barras; ?>").barcode("<?php echo $row->cod_barras; ?>", "code128");     
                        });
                        </script>
                        <div id="bcTarget_<?php echo $row->cod_barras; ?>" style="margin: auto; "></div>
                    -->
                        <img src="<?php echo base_url() ?>codigo_barra/barcode.php?codetype=code128&text=<?php echo $row->cod_barras; ?>" />
                         <p class="nro_codbarras"><?php echo $row->cod_barras; ?></p>
                    <label class="titulo_juego"><?php echo trim($producto[0]->plat_descripcion); ?> - <?php echo trim($producto[0]->nombre); ?> </label>
                 </div>
                </div>
               </td>   
               <?php 
               $columna++;
               }
                if($columna == $maxcolumna)
               {  
                ?>
               <td> 
               <div class="lista_prod_x_cod">
                 <p class="cod_barras_x_prod_estado">Estado : <?php echo strtoupper($row->estado); ?> </p>
                 <div class="cod_barras_x_prod">
                      <!-- <script>
                        $(document).ready(function(){
                        $("#bcTarget1_<?php echo $row->cod_barras; ?>").barcode("<?php echo $row->cod_barras; ?>", "code128");     
                        });
                        </script>
                        <div id="bcTarget1_<?php echo $row->cod_barras; ?>" style="margin: auto; "></div>-->
                        
                       
                     <img src="<?php echo base_url() ?>codigo_barra/barcode.php?codetype=code128&text=<?php echo $row->cod_barras; ?>" />
                     <p class="nro_codbarras"><?php echo $row->cod_barras; ?></p>
                    <label class="titulo_juego"><?php echo trim($producto[0]->plat_descripcion); ?> - <?php echo trim($producto[0]->nombre); ?> </label>
                 </div>
                </div>
               </td>
               <?php 
               echo "</tr>";
               $columna=1;
               $fila++;
               }
            $i++; } ?>
               
           </table>    
        <!-- <br><HR width=100% align="left"> -->
     
</body>
</html>
