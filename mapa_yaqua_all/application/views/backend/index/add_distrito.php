<div class="row-fluid">
	<div class="span12">
            
        <div class="widget-box">
            <div class="widget-title">
                <h5>AGREGAR DE DISTRITO</h5>
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
                     <input type="hidden" name="id" value="" />
                     <input style="width: 60%;" type="text" name="descripcion" value="<?php echo set_value("descripcion") ?>" required="required" />
                    </div>
                  
                  	<div class="div_formulario">
                     <label class="label_formmembresia">Ciudad :</label>
                     <select name="ciudad" id="ciudad" style="width: 61%;" required="required">
                        <option value="">SELECCIONE UNA CIUDAD</option>
                        <?php
                            foreach($datos_ciudad as $ciudad)
                            {
                            ?>
                            <option value="<?php echo $ciudad->id_ciudad ?>" <?php echo set_select('ciudad',$ciudad->id_ciudad);?>> <?php echo $ciudad->ciu_descripcion ?></option>
                            <?php
                            }
                            ?>
                    </select>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">URL del mapa</label>
                     <textarea id="url_mapa" name="url_mapa" style="width: 60%; height: 200px;"><?php echo set_value("url_mapa") ?></textarea>
                    </div>
                    
                    <div class="div_formulario">
                      <label class="label_formestado">Estado :</label>
                      <select name="estado" style=" width:108px;" required="required"> 
                         <option value="habilitado"    <?php echo set_select('estado','habilitado');?>>Habilitado</option>
                         <option value="deshabilitado" <?php echo set_select('estado','deshabilitado');?>>Deshabilitado</option>
                      </select>
                    </div>
                                      
                    <br />
                    <button class="btn btn-danger btn-mini" type="submit">GUARDAR</button>
                    <a class="btn btn-danger btn-mini" href="<?php echo base_url() ?>backend/index/listar_distritos" >Cancelar</a>
                    
                </div>
                <?php echo form_close() ?>
                <!-- FIN contiene el formulario -->
            </div>
            
        </div>
	</div>
</div>