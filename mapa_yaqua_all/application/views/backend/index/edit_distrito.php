<div class="row-fluid">
	<div class="span12">
            
        <div class="widget-box">
            <div class="widget-title">
                <h5>EDICION DE DISTRITO</h5>
            </div>
            <div class="widget-content">
              <!-- contiene el formulario -->
              	<?php echo validation_errors() ?>
				<?php 
                if ( $this->session->flashdata('ControllerMessage') != '' ) 
                    {
                ?>
                <p style="color: red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
                <?php 
                } 
                ?>
                <?php
				$atributos = array( 'id' => 'form','name'=>'form');
				//echo form_open(null, $atributos);
				echo form_open_multipart(null,$atributos);
				?>
                <div>
                    <div class="div_formulario">
                     <label class="label_formmembresia">Descripcion :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id_distrito; ?>" />
                     <input style="width: 60%;" type="text" name="descripcion" value="<?php echo $datos[0]->dis_descripcion; ?>" required="required" />
                    </div>
                  
                  	<div class="div_formulario">
                     <label class="label_formmembresia">Ciudad :</label>
                     <select name="ciudad" id="ciudad" style="width: 61%;">
                        <option value="0">SELECCIONE UNA CIUDAD</option>
                        <?php
                            foreach($datos_ciudad as $ciudad)
                            {
                            ?>
                            <option value="<?php echo $ciudad->id_ciudad ?>" <?php if($ciudad->id_ciudad==$datos[0]->id_ciudad){ echo 'selected="selected"';}?>> <?php echo $ciudad->ciu_descripcion ?></option>
                            <?php
                            }
                            ?>
                    </select>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">URL del mapa</label>
                     <textarea id="url_mapa" name="url_mapa" style="width: 60%; height: 200px;"><?php echo $datos[0]->dis_mapa; ?></textarea>
                    </div>
                    <div class="div_formulario">
                     <label class="label_formmembresia">URL del mapa</label>
                     <?php echo htmlspecialchars_decode($datos[0]->dis_mapa); ?>
                    </div>
                    
                    <div class="div_formulario">
                      <label class="label_formestado">Estado :</label>
                      <select name="estado" style=" width:108px;" required="required"> 
                         <option value="habilitado"    <?php if($datos[0]->dis_estado=="habilitado"){echo "selected";} ?>>Habilitado</option>
                         <option value="deshabilitado" <?php if($datos[0]->dis_estado=="deshabilitado"){echo "selected";}?>>Deshabilitado</option>
                      </select>
                    </div>
                                      
                    <br />
                    <button class="btn btn-danger btn-mini" type="submit">Actualizar</button>
                    <a class="btn btn-danger btn-mini" href="<?php echo base_url() ?>backend/index/listar_distritos" >Regresar</a>
                    
                </div>
                <?php echo form_close() ?>
                <!-- FIN contiene el formulario -->
            </div>
            
        </div>
	</div>
</div>