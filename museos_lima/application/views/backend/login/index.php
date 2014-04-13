		<div id="logo">
            <img src="<?php echo base_url()?>public/backend/img/logo.png" alt="" />
        </div>
        <div id="loginbox">     
        	<?php
       	 	$atributos = array( 'id' => 'loginform','class' => 'form-vertical','name'=>'form');
        	echo form_open(null, $atributos);
        	?>       
				<p>Introduzca usuario y contraseña.</p>
                <?php echo validation_errors(); ?>
				<?php 
                if ( $this->session->flashdata('ControllerMessage') != '' ) 
                    {
                ?>
                <p style="color: red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
                <?php 
                } 
                ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Usuario" name="login" value="<?php echo set_value("login") ?>" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="pass" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Entrar" /></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical" />
				<p>Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				<div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link" id="to-login">&lt; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Recover" /></span>
                </div>
            </form>
        </div>