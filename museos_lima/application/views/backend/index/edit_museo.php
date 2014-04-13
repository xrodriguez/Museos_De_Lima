<div class="row-fluid">
	<div class="span12">
            
        <div class="widget-box">
            <div class="widget-title">
                <h5>EDICION DE MUSEO</h5>
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
                     <label class="label_formmembresia">Nombre :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Nombre" value="<?php echo $datos[0]->Nombre; ?>" required="required" />
                    </div>
                  
                  	<div class="div_formulario">
                     <label class="label_formmembresia">Categoria :</label>
                     <select name="categoria" id="categoria" style="width: 61%;">
                        <option value="0">SELECCIONE UNA CATEGORIA</option>
                        <?php
                            foreach($datos_ciudad as $categoria)
                            {
                            ?>
                            <option value="<?php echo $categoria->id_categ ?>" <?php if($categoria->id_categ==$datos[0]->id_categ){ echo 'selected="selected"';}?>> <?php echo $categoria->nombre ?></option>
                            <?php
                            }
                            ?>
                    </select>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Ubicacion :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Ubicacion" value="<?php echo $datos[0]->Ubicacion; ?>" required="required" />
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Direccion :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Direccion" value="<?php echo $datos[0]->Direccion; ?>" required="required" />
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Horario :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Horario" value="<?php echo $datos[0]->Horario; ?>"/>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Costo :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Costo" value="<?php echo $datos[0]->Costo; ?>"/>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Telefono :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Telefono" value="<?php echo $datos[0]->Telefono; ?>"/>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Correo :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Correo" value="<?php echo $datos[0]->Correo; ?>"/>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">Web :</label>
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id; ?>" />
                     <input style="width: 60%;" type="text" name="Web" value="<?php echo $datos[0]->Web; ?>"/>
                    </div>
                    
                    <div class="div_formulario">
                     <label class="label_formmembresia">URL del mapa</label>
                     <textarea id="url_mapa" name="url_mapa" style="width: 60%; height: 200px;"><?php echo $datos[0]->url; ?></textarea>
                    </div>
                    
                    
                    <div class="div_formulario">
                      <label class="label_formestado">Estado :</label>
                      <select name="estado" style=" width:108px;" required="required"> 
                         <option value="habilitado"    <?php if($datos[0]->estado=="habilitado"){echo "selected";} ?>>Habilitado</option>
                         <option value="deshabilitado" <?php if($datos[0]->estado=="deshabilitado"){echo "selected";}?>>Deshabilitado</option>
                      </select>
                    </div>
                                      
                    <br />
                    <button class="btn btn-danger btn-mini" type="submit">Actualizar</button>
                    <a class="btn btn-danger btn-mini" href="<?php echo base_url() ?>backend/index/listar_museos" >Regresar</a>
                    
                </div>
                <?php echo form_close() ?>
                <!-- FIN contiene el formulario -->
            </div>
            
        </div>
	</div>
</div>