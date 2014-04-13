<div class="row-fluid">
	<div class="span12">
            
        <div class="widget-box">
            <div class="widget-title">
                <h5>AGREGAR CATEGORIA</h5>
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
                     <label class="label_formmembresia">Nombre:</label>
                     <input type="hidden" name="id" value="" />
                     <input style="width: 60%;" type="text" name="nombre" value="<?php echo set_value("nombre") ?>" required="required" />
                    
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
                    <a class="btn btn-danger btn-mini" href="<?php echo base_url() ?>backend/index/listar_categorias" >Cancelar</a>
                    
                </div>
                <?php echo form_close() ?>
                <!-- FIN contiene el formulario -->
            </div>
            
        </div>
	</div>
</div>