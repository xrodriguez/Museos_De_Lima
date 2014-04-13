<?php 
$ico_detalle='<div class="procesar"><img src="'.base_url().'public/backend/img/detalle.png" width="18px" height="18px" title="Ver detalles"></div>';    
$ico_editar='<div class="procesar"><img src="'.base_url().'public/backend/img/pencil.png" width="18px" height="18px" title="Editar"></div>';
$ico_email='<div class="procesar"><center><img src="'.base_url().'public/backend/img/mail.fw.png" width="18px" height="18px" title="Remitir Email"></center></div>';
$ico_esta_cta='<div class="procesar"><img src="'.base_url().'public/backend/img/coins_icon.gif" width="18px" height="18px" title="Ver Estado Cuenta"></div>';
$ico_suspender='<div class="procesar"><img src="'.base_url().'public/backend/img/reg_anulado.png" width="15px"  title="Deshabilitar Multa"></div>';
$ico_suspender_opaco='<div class="procesar"><img src="'.base_url().'public/backend/img/reg_anulado_opaco.png" width="15px"  title="Deshabilitar Multa"></div>';
$ico_activar='<div class="procesar"><img src="'.base_url().'public/backend/img/redo.png" width="15px"  title="Activar Suscripción"></div>';
$ico_anular='<div class="procesar"><img src="'.base_url().'public/backend/img/cross.png" width="15px"  title="ANULAR definitivamente la Suscripción"></div>';
$ico_anular_opaco='<div class="procesar"><img src="'.base_url().'public/backend/img/cross_deshabilitado.png" width="15px"  title="ANULAR definitivamente la Suscripción"></div>';
$ico_procesar='<div class="procesar"><center><img src="'.base_url().'public/backend/img/procesar.gif" width="18px" height="18px" title="Suscribir cliente"></center></div>';
$ico_ordenrecog='<div class="procesar"><center><img src="'.base_url().'public/backend/img/generar_orden.png" width="18px" height="18px" title="Solicitar Orden Recogo de VJ"></center></div>';
$ico_ordenrecog_opaco='<div class="procesar"><center><img src="'.base_url().'public/backend/img/generar_orden_deshabilitado.png" width="18px" height="18px" title="Solicitar Orden Recogo de VJ"></center></div>';

?>
<div class="row-fluid">
	<div class="span12">
            <div class="buttons" style="float:right;">
		 
                <a class="btn btn-success btn-mini" href="<?php echo base_url()?>backend/index/add_distrito"  id="add-event">
                    <i class="icon-plus icon-white">
                </i> Nuevo</a>
		</div>
            <br />
            
                              <
        <div class="widget-box">
            <div class="widget-title">
                <h5>LISTADO DE DISTRITOS</h5>
            </div>
            <div class="widget-content nopadding">
            
              <?php 
                if ( $this->session->flashdata('ControllerMessage') != '' ) {
                ?>
                <div id="<?php echo $this->session->flashdata('ControllerMessageTipo'); ?>">
                   <p><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
                </div>
            <?php } ?> 
                 
                </table>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                         <th WIDTH="3%">#</th> 
                         <th WIDTH="5%">Ciudad</th> 
                         <th WIDTH="10%">Distrito</th> 
                         <!-- <th WIDTH="10%">Mapa</th> -->
                         <th WIDTH="15%">URL</th> 
                         <th WIDTH="8%">Estado</th> 
                         <th WIDTH="10%">Accion</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($pagina){$i=$porpagina+1;}
                    else{$i=1;}
                
                    if(isset($datos)):
                    foreach($datos as $rowdato)
                    {
						
                        //buscamos el detalle de la membresia
                        $id =$rowdato->id_distrito;
                        $id_ciudad=$rowdato->id_ciudad;
                        $row_ciudad= $this->super_model->buscarciudad_xid($id_ciudad);
                        $ciudad = $row_ciudad[0]->ciu_descripcion;
                        $distrito=$rowdato->dis_descripcion;
                        $url_mapa=$rowdato->dis_mapa;
                        
                        $estado=$rowdato->dis_estado;
                     ?>
                        <tr class="gradeX">
                           
                            <td  style="color:#ffa500;"><?php echo $i; ?></td>
                             <td style="text-align:left !important; padding-left: 5px;"><?php echo $ciudad; ?></td>
                             <td style="text-align:left !important; padding-left: 5px;"><?php echo $distrito; ?></td>
                             <!--
                             <td style="text-align:left !important; padding-left: 5px;"><?php 
                                $vieja = 'width="425" height="350"';
                                $nueva = 'width="180" height="120"';
                                $mapa =str_replace($vieja , $nueva , $url_mapa);
                                echo htmlspecialchars_decode($mapa); 
                             ?>
                             </td>-->
                             <td style="text-align:left !important; padding-left: 5px; font-size:0.8em;  "><?php echo $url_mapa ?></td>
                             <!-- <td style="text-align:left !important; padding-left: 5px;"><?php echo htmlspecialchars_decode($url_mapa) ?></td>-->
                             <td>
                                 <span class="label <?php if($estado=="habilitado"){echo 'label-success';} ?>"><?php echo $estado ?></span>
                             </td>
                            
                             
                             <td> <!-- TD de Accion-->
                    <a href="<?php echo base_url()?>backend/index/edit_distrito/<?php echo $id ?>"><?php echo $ico_editar; ?></a> 
                                 |
                              <?php if($estado=='habilitado'){?>
                              <a href="#myAlertB<?php echo $id; ?>" data-toggle="modal" ><?php echo $ico_suspender; ?></a> 
                              <?php }else{ echo $ico_suspender_opaco; } ?>
                              
                              <!-- Pop up de mensaje de suspender -->
                              <form  action="" name="basic_validate" id="basic_validate  B<?php echo $id; ?>" method="post" >
                                <input type="hidden" name="pagina_post" value="<?php echo $pagina; ?>" />
                                <input type="hidden" name="id_distrito" value="<?php echo $id; ?>" />   
                                <input type="hidden" name="tipo_proceso" value="suspender" /> 
                               <div id="myAlertB<?php echo $id; ?>" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                        <h3>Suspender Distrito</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Desea Deshabilitar el distrito?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button class="btn btn-primary" type="submit"> SUSPENDER</button>
                                        <a data-dismiss="modal" class="btn" href="#">Cancelar</a>
                                        
                                    </div>
                              </div>
                              </form>   
                              <!-- FIn Pop up de mensaje de suspender -->
                              
                             
                              
                            </td><!-- Fin del TD de accion -->
                        </tr>
                    <?php    
                    $i++;
                    }
                    else: ?>
                        <tr><td colspan="8"> No se tiene ningún item registrado</td>
                        </tr>    
                    <?php endif;
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="paginador"><?php echo $this->pagination->create_links()?></div>
        </div>
	</div>
</div>