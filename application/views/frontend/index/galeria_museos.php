<?php
if($pagina){$i=$porpagina+1;}
                    else{$i=1;}
?>
<div class="title with_breadcrumbs " style="">
    <div class="title_holder">
        <div class="container">
            <div class="container_inner clearfix">
                <div class="breadcrumb"> 
                    <div class="breadcrumbs">
                        <a href="#">Home</a><span class="delimiter">&#47;</span>
                        <h1 class="current">Lista de Museos</h1>
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


        <div  class="wpb_row vc_row-fluid" style="text-align:left;">
            <div class="vc_span12 wpb_column column_container">
                <div class="wpb_wrapper">
                    <div class='projects_holder_outer v4'>
                        <div class='filter_outer'>
                            <div class='filter_holder'>
                                <ul>

                                    <li class='filter' data-filter='all'><span>All</span></li>
                                    <?php if ($array_categoria != NULL)
                                    {foreach($array_categoria as $row_cat)
                                     {?>
                                    <li class='filter' data-filter='<?php echo $row_cat->id_categ;?>'>
                                        <span><?php echo $row_cat->nombre;?></span></li>
                                    <?php }}?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class='projects_holder clearfix v4 hover_text'>
                            
                            <?php
                            if($array_museos!= NULL){
                            foreach($array_museos as $row)
                                {
                                  $row_ciudad= $this->super_model->buscarciudad_xid($row->id_categ);
                                  $categoria = $row_ciudad[0]->nombre;
                                
                                    
                       ?>
                            <article class='mix <?php echo $row->id_categ;?>'>
                                <div class='image_holder'>
                                    <span class='image'>
                                        <img width="707" height="530" src="<?php echo base_url()?>public/frontend/uploads/<?php echo $row->imagen; ?>" class="attachment-full wp-post-image" alt="<?php echo $row->Nombre; ?>" />
                                    </span>
                                    <span class='text_holder'>
                                        <span class='text_outer'>
                                            <span class='text_inner'>
                                                <span class='feature_holder'>
                                                    <h4 class="portfolio_title">
                                                        <a href="#"><?php echo $row->Nombre; ?></a>
                                                    </h4>
                                                    <h6 class="project_category"><?php echo $categoria; ?></h6>
                                                    <span class="feature_holder_icons">
                                                        <a class='lightbox' title='Titulo del enlace' href='<?php echo base_url()?>public/frontend/uploads/<?php echo $row->imagen; ?>' width="178" height="133"  data-rel='prettyPhoto[pretty_photo_gallery2]'>
                                                            <img class='icon-search icon-2x' src="<?php echo base_url()?>public/frontend/resource/img/detalle.png">
                                                        </a>


                                                        <a class='preview' href="<?php echo base_url()?>index/detalle_museo/<?php echo $row->id."/".$pagina; ?>">
                                                                <!-- <i class='icon-link icon-2x'></i> -->
                                                            <img class='icon-search icon-2x' src="<?php echo base_url()?>public/frontend/resource/img/enlace.png">
                                                        </a>

                                                        <span class='portfolio_like'>
                                                            <a class="qode-like" id="qode-like-43" title="Like this">
                                                                    <!-- <i class="icon-heart icon-large"></i> -->
                                                                <img class='icon-search icon-2x' src="<?php echo base_url()?>public/frontend/resource/img/like.fw.png">
                                                            </a>
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </article>
                            <?php }
                            
                            } ?>
                            <div class='filler'></div>
                            <div class='filler'></div>
                            <div class='filler'></div>
                            <div class='filler'></div>
                        </div>
                    </div><div class="wpb_content_element separator  transparent center  " style="margin-top:20px;margin-bottom:20px;"></div>
                     <div class="paginador"><?php echo $this->pagination->create_links()?></div>
                </div> 
            </div> 
        </div>

    </div>
</div> 
<div class="content_bottom" >
    <div class='qode_call_to_action container' style=''>
        <div class='container_inner'>
            <section class='grid_section'><div class='two_columns_75_25 clearfix'>
                    <div class='column1 call_to_action_text_wrapper wpb_column column_container'>
                        <div class='column_inner call_to_action_text_wrapper wpb_column column_container'>
                           
                        </div></div>
                    <div class='column2 call_to_action_button_wrapper right'>
                        <div class='column_inner'>
                            <a href='#' target='_blank' class='qbutton  normal' style=''>LINK</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>		
</div>