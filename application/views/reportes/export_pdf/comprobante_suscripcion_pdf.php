<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Comprobante de PAGO</title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>public/frontend/css/style_wz.css">
</head>
<body>
	
        <h2 class="cabecera_docimprimir">COMPROBANTE DE PAGO</h2> 
        <div class="logo_imprimir"><img src="<?php echo base_url()?>public/frontend/images/logo.png" ></div>
        </br>
        <HR width=50% align="left"> 
        <p><label class="titu_pago_ecommerce">Datos del Cliente :</label> </p>
            <div class="info_pedido2">
                <p><div class="titu_cont">Cliente : </div><div class="cont_datospago"><?php echo strtoupper($cliente[0]->cli_apellidos).", ".strtoupper($cliente[0]->cli_nombres); ?></div></p>
                <p><div class="titu_cont">Email : </div><div class="cont_datospago"><?php echo $cliente[0]->cli_email; ?></div></p>
            </div>    
        <p><label class="titu_pago_ecommerce">Datos del Pago :</label> </p>
            <div class="info_pedido2">
            <p><div class="titu_cont">Nro de pedido : </div><div class="cont_datospago"><?php echo $ped_vta[0]->id_pedidovta; ?></div></p>
            <p><div class="titu_cont">TarjetaHabiente : </div><div class="cont_datospago"><?php echo strtoupper($ped_vta[0]->ped_nomcli_tarj); ?></div></p>
            <p><div class="titu_cont">Nro de Tarjeta : </div><div class="cont_datospago"><?php echo $ped_vta[0]->ped_nrotarj_pago; ?></div></p>
            <p><div class="titu_cont">Fecha de pedido : </div><div class="cont_datospago"><?php echo fecha_mysql_a_espanol($ped_vta[0]->ped_fechreg); ?></div></p>
            <p><div class="titu_cont">Moneda : </div><div class="cont_datospago">Nuevos Soles (S/.)</div></p>
            <p><div class="titu_cont">Importe transacci&oacute;n : </div><div class="cont_datospago"><?php echo number_format($ped_vta[0]->ped_monto,2); ?></div></p>
            <p><div class="titu_cont">Descripci&oacute;n Producto: </div><div class="cont_datospago">Primera cuota Suscripci&oacute;n del plan</div></p>
                
            </div>
        <p>
             <div style="text-align:center; position:relative">
                 <img src="<?php echo base_url() ?>codigo_barra/barcode.php?codetype=code128&text=<?php echo $ped_vta[0]->id_pedidovta;; ?>" height="50"/>
            </div>
        </p>
        <P>
            <strong>Gracias, </strong></br>
            <label class="nota_mensaje">
            para cualquier duda o problema favor de remitirnos un email a <strong>soporte@smartgamers.com.pe</strong>
            </label></br>
        </p>
</body>
</html>
