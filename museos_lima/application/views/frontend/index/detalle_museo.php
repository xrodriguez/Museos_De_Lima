<?php     

$row_ciudad= $this->super_model->buscarciudad_xid($data_museo[0]->id_categ);
$categoria = $row_ciudad[0]->nombre;
?>
<div class="title with_breadcrumbs " style="">
                            <div class="title_holder">
                                <div class="container">
                                    <div class="container_inner clearfix">
                                        <div class="breadcrumb"> 
                                            <div class="breadcrumbs">
                                                <a href="#">Home</a>
                                                <span class="delimiter">&#47;</span>
                                                <a href="<?php echo base_url()?>index">Lista de Museos</a>
                                                <span class="delimiter">&#47;</span>
                                                <h1 class="current">Detalle</h1>
                                            </div>
                                        </div>																								
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a id='back_to_top' href='#'>
                            <span class="icon-stack">
                                <img src="<?php echo base_url()?>public/frontend/resource/img/top.png"></i>
                            </span>
                        </a>

                        <div class="container">
                            <div class="container_inner clearfix">
                                <div class="portfolio_single">
                                    <div class="two_columns_66_33 clearfix portfolio_container">
                                        <div class="column1">
                                            <div class="column_inner">
                                                <div class="flexslider">
                                                    <ul class="slides">

                                                        <li class="slide">
                                                            <img src="<?php echo base_url()?>public/frontend/uploads/<?php echo $data_museo[0]->imagen; ?>" alt="" />
                                                        </li>	
                                                        <li class="slide">
                                                            <img src="<?php echo base_url()?>public/frontend/uploads/<?php echo $data_museo[0]->imagen; ?>" alt="" />
                                                        </li>	
	

                                                    </ul>
                                                </div>
                                                <div class="flexslider">
                                                    <?php 
                                                    $vieja = 'width="425" height="350"';
                                                    $nueva = 'width="492" height="360"';
                                                    $url_mapa =str_replace($vieja , $nueva , $data_museo[0]->url);
                                                    echo $url_mapa; ?>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="column2">
                                            <div class="column_inner">
                                                <div class="portfolio_detail">
                                                    <div class="info">
                                                        <h6 class="titulo_museo"><?php echo $data_museo[0]->Nombre; ?></h6>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Categoria</h6>
                                                        <p><?php echo $categoria; ?></p>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Ubicaci&oacute;n </h6>
                                                        <span class="category">
                                                            <?php echo $data_museo[0]->Ubicacion; ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Direcci&oacute;n </h6>
                                                        <span class="category">
                                                            <?php echo $data_museo[0]->Direccion; ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Horario </h6>
                                                        <span class="category">
                                                            <?php echo $data_museo[0]->Horario; ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Costo</h6>
                                                        <span class="category">
                                                            <?php echo $data_museo[0]->Costo; ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Tel&eacute;fonos</h6>
                                                        <span class="category">
                                                            <?php if($data_museo[0]->Telefono!="")
                                                                    {echo $data_museo[0]->Telefono;}
                                                                  else
                                                                  { echo "---";}
                                                                    ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Email</h6>
                                                        <span class="category">
                                                            <?php if($data_museo[0]->Correo!="")
                                                                    {echo $data_museo[0]->Correo;}
                                                                  else
                                                                  { echo "---";}
                                                                    ?>
                                                        </span>
                                                    </div>
                                                    <div class="info">
                                                        <h6>Web</h6>
                                                        <span class="category">
                                                            <?php if($data_museo[0]->Web!="")
                                                                    {echo $data_museo[0]->Web;}
                                                                  else
                                                                  { echo "---";}
                                                                    ?>
                                                        </span>
                                                    </div>
                                                    
                                                    <h6>ABOUT</h6>
                                                    <p style="text-align: justify;">
                                                        <?php if($data_museo[0]->acerca!="")
                                                                    {echo $data_museo[0]->acerca;}
                                                                  else
                                                                  { echo "---";}
                                                                    ?>
                                                    </p>
                                                    									
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="portfolio_navigation">
                                        <div class="portfolio_prev"><a href="#">
                                                <img class='icon-search icon-2x' src="<?php echo base_url()?>public/frontend/resource/img/flecha_izq.png"></a></div>
                                        <div class="portfolio_button">
                                        </div>
                                        <div class="portfolio_next"><a href="#" rel="next"><img class='icon-search icon-2x' src="<?php echo base_url()?>public/frontend/resource/img/flecha_der.png"></a>
                                        </div>
                                    </div>
                                    -->

                                </div>
                            </div>
                        </div>
                        <div class="content_bottom" >
                            <div class='qode_call_to_action container' style=''>
                                <div class='container_inner'>
                                    <section class='grid_section'><div class='two_columns_75_25 clearfix'>
                                            <div class='column1 call_to_action_text_wrapper wpb_column column_container'>
                                                <div class='column_inner call_to_action_text_wrapper wpb_column column_container'>
                                                    <p style=''>
						"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt !</p>
                                                </div></div>
                                            <div class='column2 call_to_action_button_wrapper right'>
                                                <div class='column_inner'>
                                                    <a href="<?php echo base_url()?>index" class='qbutton  normal'>Regresar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>		
                        </div>
