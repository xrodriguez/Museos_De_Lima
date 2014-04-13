<div class="row-fluid">
	<div class="span12">
            
        <div class="widget-box">
            <div class="widget-title">
                <h5>EDICION DE CATEGORIA</h5>
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
                     <input type="hidden" name="id" value="<?php echo $datos[0]->id_categ; ?>" />
                     <input style="width: 60%;" type="text" name="nombre" value="<?php echo $datos[0]->nombre; ?>" required="required" />
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
                    <a class="btn btn-danger btn-mini" href="<?php echo base_url() ?>backend/index/listar_categorias" >Regresar</a>
                    
                </div>
                <?php echo form_close() ?>
                <!-- FIN contiene el formulario -->
            </div>
            
        </div>
	</div>
</div>