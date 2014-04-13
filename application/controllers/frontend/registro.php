<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registro extends CI_Controller {
	
    public function __construct()
    {
            parent::__construct();
            $this->layout->setLayout('frontend-internas');
            $this->load->model('model_wz');
    }

    public function index()
    {
            $this->step_1();
    }
    public function step_1()
    {
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
                
        $this->form_validation->set_rules('nombres', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|numeric|xss_clean|exact_length[8]|callback__dni_check');
        $this->form_validation->set_rules('celular', 'Celular', 'trim|required|numeric|min_length[9]');
        $this->form_validation->set_rules('dia', 'Dia', 'trim|required');
        $this->form_validation->set_rules('mes', 'Mes', 'trim|required');
        $this->form_validation->set_rules('anio', 'Año', 'trim|required');
        
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono2', 'Telefono2', 'trim|xss_clean');
        $this->form_validation->set_rules('anexo2', 'Anexo 2', 'trim|xss_clean');
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback__email_check');
        $this->form_validation->set_rules('reemail', 'Re-Email', 'trim|required|xss_clean|valid_email|matches[email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|md5');
        $this->form_validation->set_rules('repassword', 'Re-password', 'trim|required|xss_clean|matches[password]|md5');
        $this->form_validation->set_rules('acepto', 'Acepto los Terminos y Condiciones', 'required');
        
        //$this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('required', 'Requerido');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener 8 Digitos');
        $this->form_validation->set_message('min_length', 'El %s debe contener minimo de 9 digitos');
        $this->form_validation->set_message('valid_email', 'El %s no es un formato correcto');
        $this->form_validation->set_message('numeric', 'El %s debe contener solo Numeros');
        $this->form_validation->set_message('_fechnac', 'La fecha de nacimiento es requerida');
        $this->form_validation->set_message('_username_check', 'El %s ya existe');
        $this->form_validation->set_message('_email_check', 'El %s ingresado ya se encuentra registrado,favor de loguearse con el email registrado anteriormente y sera redireccionado al paso que se quedo.');
        $this->form_validation->set_message('_dni_check', 'El nro de DNI ingresado ya se encuentra registrado, favor de loguearse con el email registrado anteriormente y sera redireccionado al paso que se quedo.');
        $this->form_validation->set_message('matches', 'Los  campos repetidos NO coinciden');
        
        
         if($this->form_validation->run()!=FALSE){
           
            $activation_code= $this->_random_String(10);
             
            $data_formulario_uno=array //Llenamos el array con los datos del formulario
            (
                'cli_nombres' => $this->input->post("nombres",true),
                'cli_apellidos' => $this->input->post("apellidos",true),
                'cli_sexo' => $this->input->post("sexo",true),
                'cli_email' => $this->input->post("email",true),
                'cli_password' => $this->input->post("password",true),
                'cli_dni' => $this->input->post("dni",true),
                'cli_celular' => $this->input->post("celular",true),
                'cli_telefono1' => $this->input->post("telefono",true),
                'cli_telefono2' => $this->input->post("telefono2",true),
                'cli_anexo2' => $this->input->post("anexo2",true),
                'cli_dianac' => $this->input->post("dia",true),
                'cli_mesnac' => $this->input->post("mes",true),
                'cli_annionac' => $this->input->post("anio",true),
                'cli_estado' => 'paso1',
                'activation_code' => $activation_code
             );
            $datos_a_guardar = $this->model_wz->insertar_cliente($data_formulario_uno);
            //var_dump($data_formulario_uno);
            $cliente= $this->model_wz->buscarcliente_x_dni($this->input->post("dni",true)); 
            if($cliente!=FALSE)
            {    
                $id=$cliente[0]->id_cliente;	
                redirect('registro/create_account/'.$id); 
            }
           
         }    
       }//fin del post
            
            ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("SmartGamers - Registro de Usuarios");
            $this->layout->setSubTitle("Registro de Usuarios");
            ///////////////////////TITULOS/////////////////////
            $this->layout->view('step_1');
    }
    
        /* FUncion para insertar el nuevo cliente*/
    function create_account($id=null)
    {
        if(!$id)
	{ show_404(); }
        $this->load->helper('my_funciones_helper');
        //buscamos al cliente
        $cliente= $this->model_wz->buscarcliente_x_id($id);
        if($cliente==FALSE)//SI el cliente no existe
	{ show_404(); }
        
        $estado = $cliente[0]->cli_estado;
        if($estado!="paso1")//SI el cliente no ha terminado el paso 1
	{ show_404(); }
        
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
        
         $this->form_validation->set_rules('dir_envio', 'Direccion', 'trim|required|xss_clean');
         $this->form_validation->set_rules('nro_envio', 'NRO', 'trim|required|xss_clean');
         $this->form_validation->set_rules('dpto', 'NRO', 'trim|xss_clean');
         $this->form_validation->set_rules('dis_envio', 'Distrito', 'trim|required');
         $this->form_validation->set_rules('referencia', 'Referencia', 'trim|xss_clean|required');
         $this->form_validation->set_rules('fac_direccion', 'Direccion laboral', 'trim|xss_clean|required');
         $this->form_validation->set_rules('fac_nro', 'nro Laboral', 'trim|xss_clean|required');
         $this->form_validation->set_rules('fac_dpto', 'dpto laboral', 'trim|xss_clean');
         $this->form_validation->set_rules('fac_distrito', 'Distrito laboral', 'trim|required');
         $this->form_validation->set_rules('fac_referencia', 'Referencia', 'trim|xss_clean|required');
         $this->form_validation->set_message('required', 'Campos requeridos');
         
         if($this->form_validation->run()!=FALSE){
            $data_formulario_uno=array //Llenamos el array con los datos del formulario
            (
                'dir_tipo' => "envio",
                'dir_nro' => $this->input->post("nro_envio",true),
                'dir_dpto' => $this->input->post("dpto",true),
                'dir_direccion' => $this->input->post("dir_envio",true),
                'dir_ciudad' => $this->input->post("ci_envio1",true),
                'dir_referencia' => $this->input->post("referencia",true),
                'id_cliente' => $this->input->post("id_cliente",true),
                'id_distrito' => $this->input->post("dis_envio",true)
             );
            $data_formulario_dos=array //Llenamos el array con los datos del formulario
            (
                'dir_tipo' => "facturacion",
                'dir_nro' => $this->input->post("fac_nro",true),
                'dir_dpto' => $this->input->post("fac_dpto",true),
                'dir_direccion' => $this->input->post("fac_direccion",true),
                'dir_ciudad' => $this->input->post("fac_ciudad1",true),
                'dir_referencia' => $this->input->post("fac_referencia",true),
                'id_cliente' => $this->input->post("id_cliente",true),
                'id_distrito' => $this->input->post("fac_distrito",true)
             );
            $datos_a_guardar1 = $this->model_wz->insertar_direccion($data_formulario_uno); 
            $datos_a_guardar2 = $this->model_wz->insertar_direccion($data_formulario_dos); 
            //var_dump($data_formulario_uno);
            //var_dump($data_formulario_dos);
             $data_formulario4=array //Llenamos el array con los datos del formulario
             (  'cli_estado' => "paso2"
             );
             //var_dump($data_formulario4);
             $this->model_wz->actualizar_cliente($data_formulario4, $id);
            
            if($data_formulario_uno AND $data_formulario_dos)
            {    
                $id=$cliente[0]->id_cliente;	
                redirect('registro/create_sus/'.$id); 
            }
             
         }
        }// fin del post 
         ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("SmartGamers - Registro de Usuarios");
            $this->layout->setSubTitle("Registro de Usuarios");
            ///////////////////////TITULOS/////////////////////
            $this->layout->view('step_2',compact("cliente"));
        
    }//fin de funcion registrar
    
     function _random_string($length){
        $base ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $max =  strlen($base)-1;
        $activation_code='';
        while(strlen($activation_code)<$length)
            $activation_code.= $base{mt_rand(0, $max)};
        return $activation_code;
    }
    function _dni_check($dni){
        return $this->model_wz->dni_check($dni);
    }
    function _email_check($email){
        return $this->model_wz->email_check($email);
    }  
    
   
    
    function create_sus($id=null)
    {
        $this->load->helper('my_funciones_helper');
        $this->load->helper('lib.inc_helper');
        
        if(!$id)
	{ show_404(); }
        //buscamos al cliente
        $cliente= $this->model_wz->buscarcliente_x_id($id);
        //var_dump($cliente); exit();
        if($cliente==FALSE)//SI el cliente no existe
	{ show_404(); }
        
        $estado = $cliente[0]->cli_estado;
        if($estado=="paso1" OR $estado=="suscrito" OR $estado=="anulado" OR $estado=="suspendido")//SI el cliente no ha terminado el paso 2
	{ show_404(); }
        
        $cod_error =$this->uri->segment(4);
        if($cod_error != FALSE)
        {
           $tipo_mensaje= "mensaje_error";
           $mensajes_visa = $this->model_wz->buscar_codvisa($cod_error);
           $msj= $mensajes_visa[0]->codvis_descripcion;
           $mensaje = " ERROR DE PAGO CON VISA </br> * Motivo : ".$msj;
           $estado ="denegada";
           $ped_vta= $this->model_wz->ult_pedvtax_idcli($id,$estado);
           //var_dump($ped_vta);exit();
        }else    
        { $tipo_mensaje= "";
           $mensaje = "";
           $ped_vta="";
        }
           
           
        //buscamos suscripcion pendientes, activas o suspendidas del cliente
        $suscripcion = $this->model_wz->busq_Suscripx_idcli($id);
        //var_dump($suscripcion);exit();
                
        if($suscripcion!=FALSE)//SI exiten suscripciones previas
	{ //show_404(); 
            //var_dump($suscripcion);
            $nro_itemactual=$suscripcion[0]->nro_itemactual;
            $estado_entrega=$suscripcion[0]->estado_entrega;
            $estado_suscripcion=$suscripcion[0]->estado_alquiler;
            if($nro_itemactual>0 OR $estado_entrega != "ninguna" OR $estado_suscripcion != "activo")
            {
             if($estado_suscripcion == "suspendido" )
             {  //anulamos la suscripcion antigua   
                $data_formulario1_1=array 
                (  'estado_alquiler' => 'anulado',
                   'alq_fechfin' => obtenerfecha_hora(),
                   'alq_motivoanu'=>'Anulado por nueva suscripcion'
                );
                $this->model_wz->actualizar_suscripcion($data_formulario1_1,$suscripcion[0]->id_alquiler);
             }
             
             $data_formulario1_2=array 
             (  'tarj_estado' => 'deshabilitado' );
             
             if($estado =="paso3")
             {   $data_formulario1_3=array 
                 (  'ped_estado' => 'anulado', 
                   'ped_codautoriza_visa' => 'anulado por abandono en formulario visa' 
                );
             }else    
             { $data_formulario1_3=array 
                (  'ped_estado' => 'anulado' );
             }
               $data_formulario4=array 
             (  'cli_estado' => "paso2" );
             //var_dump($data_formulario4);
             $this->model_wz->actualizar_cliente($data_formulario4, $suscripcion[0]->id_cliente);
            
             $this->model_wz->deshabilitar_tarjeta_xidcli($data_formulario1_2,$suscripcion[0]->id_cliente);
             $this->model_wz->actualizar_pedidovta_2($data_formulario1_3,$suscripcion[0]->id_alquiler);
             
            }else
            {
                $this->session->set_flashdata('ControllerMessageTipo', 'mensaje_error');
                $this->session->set_flashdata('ControllerTituMessage', 'Error de Suscripción');
                $this->session->set_flashdata('ControllerMessage', 'Lo sentimos, el presente cliente tiene una suscripción activa.');
                redirect(base_url().'index/mensajes_sistema/',  301);
            }
        }
        
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
        
         $this->form_validation->set_rules('banco', 'Banco', 'trim|required|xss_clean');
         $this->form_validation->set_rules('tipo', 'Tipo', 'required');
         $this->form_validation->set_rules('plan', 'Plan', 'required');
         $this->form_validation->set_rules('nro_tarj', 'Nro de tarjeta', 'trim|required|xss_clean|numeric|exact_length[16]');
         $this->form_validation->set_rules('cod_seguridad', 'Codigo de seguridad', 'trim|required|xss_clean|numeric');
         $this->form_validation->set_rules('mes_cad', 'Mes', 'trim|required');
         $this->form_validation->set_rules('anio_cad', 'Año', 'trim|required');
         $this->form_validation->set_rules('id_cliente', 'Cliente', 'trim|required');
        
         $this->form_validation->set_message('required', 'Requerido');
         $this->form_validation->set_message('numeric', 'El %s debe contener solo Numeros');
         $this->form_validation->set_message('exact_length', 'El %s debe contener 16 Digitos');
         
        
         if($this->form_validation->run()!=FALSE)
         {
            //var_dump($_POST);  
             $id_cliente=$this->input->post("id_cliente",true);
            
            // consultamos los datos del plan para crear la suscripcion
             $plan= $this->model_wz->buscarplan_xid($this->input->post('plan'));
             $precioneto= $plan[0]->mem_precio;
             $igv= $plan[0]->mem_igv;
             $preciototal= $plan[0]->mem_total;
             $nromax= $plan[0]->mem_nromaxitem;
            
            //buscamos suscripcion pendientes, activas o suspendidas del cliente
            $suscripcion = $this->model_wz->busq_Suscripx_idcli($id_cliente);
            if($suscripcion==FALSE)//si NO existen suscripciones previas
            {    //insertamos una nueva suscripcion
                $data_formulario_uno=array 
                (
                   'id_cliente' => $id_cliente,
                   'id_membresia' => $this->input->post("plan",true),
                   'max_item' => $nromax,
                   'precioneto' => $precioneto,
                   'igv' => $igv,
                   'preciototal' => $preciototal
                );
                //var_dump($data_formulario_uno);
                $this->model_wz->insertar_suscripcion($data_formulario_uno);
            }
            
             //insertamos los datos de la tarjeta 
             $data_formulario_dos=array 
             (
                'tarj_nro' => $this->input->post("nro_tarj",true),
                'tarj_banco' => $this->input->post("banco",true),
                'tarj_cvv2' => $this->input->post("cod_seguridad",true),
                'tarj_mes' => $this->input->post("mes_cad",true),
                'tarj_anio' => $this->input->post("anio_cad",true),
                'id_cliente' => $id_cliente,
                'id_tipotarjeta' => $this->input->post("tipo",true)
             );
             //var_dump($data_formulario_dos);
             $this->model_wz->insertar_tarjeta($data_formulario_dos);
             
             //actualizamos el estado del cliente
             $data_formulario4=array 
             (  'cli_estado' => "paso3" );
             //var_dump($data_formulario4);
             $this->model_wz->actualizar_cliente($data_formulario4, $id_cliente);
             
             //consultamos la ultima suscripcion q tiene el cliente
             $suscripcion= $this->model_wz->busq_Suscripx_idcli($id_cliente);
             $id_alquiler= $suscripcion[0]->id_alquiler;
             
             //creamos el pedido de vta
             $data_formulario_tres=array //Llenamos el array con los datos del formulario
             (
                'id_alquiler' => $id_alquiler,
                'ped_igv' =>$igv,
                'ped_monto' =>$preciototal
             );
             $this->model_wz->insertar_pedidovta($data_formulario_tres);
             
             $pedi = $this->model_wz->ultima_pedido_xidalq($id_alquiler);
             $id_pedidovta = $pedi[0]->id_pedidovta;
             //redirect('registro/step_4final/'.$id_cliente); 
             
             $this->envio_pedvta_avisa($id_pedidovta , $preciototal);
            
             
         }// fin de  if($this->form_validation->run()!=FALSE)
         
        }// fin del post 
        
        
        ///////////////////////TITULOS/////////////////////
            $this->layout->setTitle("SmartGamers - Registro de Usuarios");
            $this->layout->setSubTitle("Registro de Usuarios");
            ///////////////////////TITULOS/////////////////////
            $this->layout->view('step_3',compact("cliente","ped_vta","mensaje","tipo_mensaje"));
        
    }//fin de funcion registrar
    
                
    function envio_email($id_cli)
     {
         if(!$id_cli)
	{ show_404(); }
         
        $cliente= $this->model_wz->buscarcliente_x_id($id_cli);
        if($cliente!=FALSE)
        {    
           $email= $cliente[0]->cli_email;
           $name= $cliente[0]->cli_nombres." ".$cliente[0]->cli_apellidos;
           $activation_code=$cliente[0]->activation_code;
        //Email de confirmacion
            
            $this->load->library('email');
            $this->load->config('email'); 
            $this->load->helper(array('form', 'url'));
            
            $this->email->to($email);
            //$this->email->from('wzauma@smartgamers.com.pe');
            $this->email->from('servicios@smartgamers.com.pe');
            $this->email->subject('Verificacion de registro Smartgamer de '.$name);
            /*
            $this->email->message('Hola '.$name.' ,favor confirma tu registro, haciendo click en el siguiente 
                link : '.anchor('cli_controller/register_confirm/'.$activation_code,'valide su Registro en Smartgamers').' o 
                tambien puede ingresar el codigo de manera manual en la siguiente direccion: www.smartgamers.com.pe/rent/cli_controller/confirmar_registro <br> con el siguiente codigo : '.$activation_code);
             * 
             */
            $message = '<html><body>';
            $message .= '<h4>Hola '.$name.'</h4>';
            $message .= '<p>Bienvenido a Smartgamers, para validar tu registro favor de hacer click en el siguiente link : ';
            $message .= '</br>';
            $message .= anchor('index/register_confirmemail/'.$activation_code.'/'.$id_cli,'Validar Registro').'</p>';
            $message .= '<p>En caso contrario acceder a la pagina : <br>'.base_url().'index/confirmar_registro </br>';
            $message .= '</br> y ingresar el siguiente codigo de validación</p>';
            $message .= '<p><Label> CODIGO DE VALIDACION : </label> <font style="color:red;"> '.$activation_code.'</font></p>';
            $message .= '</body></html>';
            $this->email->message($message);
            if(! $this->email->send())
            {// Generate error
                 $this->email->print_debugger();
                 return FALSE;
            }else
            { return true;}    
            //fin de email de confirmacion
        }  
    } // fin de funcion envio de email
 
 
    
    
    function step_4final($id=null)
    {
        $this->load->helper('my_funciones_helper');
        
        if(!$id)
	{ show_404(); }
        //buscamos al cliente
        $cliente= $this->model_wz->buscarcliente_x_id($id);
        //var_dump($cliente); exit();
        if($cliente==FALSE)//SI el cliente no existe
	{ show_404(); }
        
        $estado = $cliente[0]->cli_estado;
        if($estado!="suscrito")//SI el cliente no ha terminado el paso 3
	{ show_404(); }
        
         $estado ="aprobada";
         $ped_vta= $this->model_wz->ult_pedvtax_idcli($id,$estado);
         $this->envio_email_bienvenida($id_cliente);  
        //envio de email de bienvenida
       // $this->envio_email($id);
        
        ///////////////////////TITULOS/////////////////////
        $this->layout->setTitle("SmartGamers - Registro de Usuarios");
        $this->layout->setSubTitle("Registro de Usuarios");
        ///////////////////////TITULOS/////////////////////
        $this->layout->view('step_4',compact("cliente","ped_vta"));
        
    }//fin de funcion mensaje
    
    function recupera_pass()
    {
        $mensaje="";
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
           $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
           if($this->form_validation->run()!=FALSE){
               //var_dump($_POST);
               //retorna false si lo encontro
               $validemail=$this-> _email_check($this->input->post("email",true));
               if($validemail==FALSE)
               {
                   $cliente= $this->model_wz->buscarcliente_x_email($this->input->post("email",true));
                   
                   $envio=$this->envio_email_actpass($cliente[0]->id_cliente);
                   if($envio)
                   {
                      $tipo_mensaje="mensaje_exito";
                       $mensaje="Se ha procedido a enviar a tu email para la actualización del nuevo password"; 
                   }    
               }else
               {
                    $tipo_mensaje="mensaje_error";
                       $mensaje="El email ingresado no se encuentra registrado, favor de verificarlo, gracias."; 
               }    
           }//fin de la validacion
        }// fin del post
         ///////////////////////TITULOS/////////////////////
        $this->layout->setTitle("SmartGamers - Registro de Usuarios");
        $this->layout->setSubTitle("Olvide mi Password");
        ///////////////////////TITULOS/////////////////////
        $this->layout->view('cli_recuperapass',compact("mensaje","tipo_mensaje"));
        
    }//fin de funcion mensaje
    
    function envio_email_actpass($id_cli)
    {
        
        if(!$id_cli)
	{ show_404(); }
        
        $cliente= $this->model_wz->buscarcliente_x_id($id_cli);
       
        if($cliente!=FALSE)
        {    
           $email= $cliente[0]->cli_email;
           $name= $cliente[0]->cli_nombres." ".$cliente[0]->cli_apellidos;
           $activation_code=$cliente[0]->activation_code;
        //Email de confirmacion
            
             $this->load->library('email');
            $this->load->config('email'); 
           
            $this->email->to($email);
           
            $this->email->from('servicios@smartgamers.com.pe');
            $this->email->subject('Actualizacion de Password de Smartgamer de '.$name);
            
            $message = '<html><body>';
            $message .= '<h4>Hola '.$name.'</h4>';
            $message .= '<p>Para cambiar tu password por uno nuevo, favor de hacer clic en el siguiente enlace: ';
            $message .= '</br>';
            $message .= anchor('registro/actualiza_pass/'.$activation_code.'/'.$id_cli,'Cambiar Password').'</p>';
            $message .= '<p>En caso contrario hacer caso omiso al email, gracias. </br>';
            $message .= '-------------- ';
            $message .= '<br>Saludos ';
            $message .= '<br>Smartgamers';
            $message .= '<br>Servicio al cliente';
            $message .= '</body></html>';
            $this->email->message($message);
            //$this->email->print_debugger();
            if(! $this->email->send())
            {// Generate error
                 $this->email->print_debugger();
                 return false;
            }ELSE
            {return TRUE;}    
            //fin de email de confirmacion
        }   
    }
        function envio_email_bienvenida($id_cli)
     {
         if(!$id_cli)
	{ show_404(); }
         
        $cliente= $this->model_wz->buscarcliente_x_id($id_cli);
        //var_dump($cliente);
        if($cliente!=FALSE)
        {    
           $email= $cliente[0]->cli_email;
           $name= $cliente[0]->cli_nombres." ".$cliente[0]->cli_apellidos;
           $activation_code=$cliente[0]->activation_code;
        //Email de confirmacion
            
            $this->load->library('email');
            $this->load->config('email'); 
            $this->load->helper(array('form', 'url'));
            
            $this->email->to($email);
            //$this->email->from('wzauma@smartgamers.com.pe');
            $this->email->from('servicios@smartgamers.com.pe');
            $this->email->subject('Bienvenido '.$name.' a Smartgamers ');
            /*
            $this->email->message('Hola '.$name.' ,favor confirma tu registro, haciendo click en el siguiente 
                link : '.anchor('cli_controller/register_confirm/'.$activation_code,'valide su Registro en Smartgamers').' o 
                tambien puede ingresar el codigo de manera manual en la siguiente direccion: www.smartgamers.com.pe/rent/cli_controller/confirmar_registro <br> con el siguiente codigo : '.$activation_code);
             * 
             */
            $message = '<html><body>';
            $message .= '<h4>Estimado '.$name.'</h4>';
            $message .= '<p> Gracias por confiar en nuestra propuesta, ya puedes realizar el pedido de videojuegos.
                Los siguientes pagos ser&aacute;n cargos autom&aacute;ticos cada 30 días, conforme los T&eacute;rminos y Condiciones.';
            $message .= '</br>Ten siempre presente lo importante que es que siempre haya alguien disponible para recepcionar los videojuegos y devolver los que puedas tener para cambiar, así no habr&aacute;n inconvenientes ni multas ';
            $message .= '</br> Bienvenido,  Smartgamers </p>';
            $message .= '</body></html>';
            $this->email->message($message); 
            
            if(! $this->email->send())
            {// Generate error
                 $this->email->print_debugger();
                 return FALSE;
            }else
            { return true;}    
            //fin de email de confirmacion
        }  
    } // fin de funcion envio de email
    
    function actualiza_pass()
    {
        $activation_code=trim($this->uri->segment(3));
        $id_cli=$this->uri->segment(4);
        $cliente= $this->model_wz->cont_validandoregistro($id_cli,$activation_code);
        if($cliente!=FALSE)
        {    
        $mensaje="";
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|md5');
            $this->form_validation->set_rules('repassword', 'Re-password', 'trim|required|xss_clean|matches[password]|md5');
            $this->form_validation->set_message('matches', 'Los passwords  NO coinciden');
            
           if($this->form_validation->run()!=FALSE)
           {
                $data_formulario4=array 
                (  'cli_password' => $this->input->post("password",true),
                );
                //var_dump($data_formulario4);
                $this->model_wz->actualizar_cliente($data_formulario4, $id_cli);
                $tipo_mensaje="mensaje_exito";
                $mensaje="Se procedio a la actualizacion del password, gracias."; 
               
           }//fin de la validacion
        }// fin del post
         ///////////////////////TITULOS/////////////////////
        $this->layout->setTitle("SmartGamers - Registro de Usuarios");
        $this->layout->setSubTitle("Actualizar mi Password");
        ///////////////////////TITULOS/////////////////////
        $this->layout->view('cli_actualizarpass',compact("mensaje","tipo_mensaje","cliente"));
        }else
        { redirect('index/login');}    
    }//fin de funcion mensaje
    
    function envio_pedvta_avisa($nroped , $monto)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('my_funciones_helper');
        $this->load->helper('lib.inc_helper');
        
        $numPedido= $nroped;
        $codTienda = CODIGO_TIENDA;
        $mount = number_format($monto,2);
        //$mount = $monto;

        //Se arma el XML de requerimiento
        $xmlIn = "";
        $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
        $xmlIn = $xmlIn . "<nuevo_eticket>";
        $xmlIn = $xmlIn . "	<parametros>";
        $xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
        $xmlIn = $xmlIn . "		";
        $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . $codTienda . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $numPedido . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" . $mount . "</parametro>";
        $xmlIn = $xmlIn . "		<parametro id=\"DATO_COMERCIO\">JOSE</parametro>";
        $xmlIn = $xmlIn . "	</parametros>";
        $xmlIn = $xmlIn . "</nuevo_eticket>";
       
        //Se asigna la url del servicio
        //En producción cambiará la URL
        $servicio= URL_WSGENERAETICKET_VISA;
//	var_dump($servicio);
        //Invocación al web service
       $client = new SoapClient($servicio);
       //var_dump($client);
        //print_r($client->GeneraEticket);

        //var_dump($client->__getFunctions());
        //exit;

        //parametros de la llamada
        $parametros=array(); 
        $parametros['xmlIn']= $xmlIn;
        //Aqui captura la cadena de resultado
        $result = $client->GeneraEticket($parametros);
        //Muestra la cadena recibida
        echo 'Cadena de respuesta: ' . $result->GeneraEticketResult . '<br>' . '<br>';

        //Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
        $xmlDocument = new DOMDocument();

        if ($xmlDocument->loadXML($result->GeneraEticketResult))
        {
                /////////////////////////[MENSAJES]////////////////////////
                //Ejemplo para determinar la cantidad de mensajes en el XML
                $iCantMensajes= $this->CantidadMensajes($xmlDocument);
                echo 'Cantidad de Mensajes: ' . $iCantMensajes . '<br>';
                    
               /*
                //Ejemplo para mostrar los mensajes del XML 
                for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++){
                    echo 'Mensaje #' . ($iNumMensaje +1) . ': ';
                    echo $this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
                    echo '<BR>';
                }
                */
                
                /////////////////////////[MENSAJES]////////////////////////

                if ($iCantMensajes == 0){
                    $Eticket= $this->RecuperaEticket($xmlDocument);
                    //echo 'Eticket: ' . $Eticket;
                    
                    $data_formulario1=array 
                    (  'ped_nroeticket' => $Eticket );
                    //var_dump($data_formulario4);
                    $this->model_wz->actualizar_pedidovta_xidped($data_formulario1, $nroped);
             
                    $html= htmlRedirecFormEticket($Eticket);
                    echo $html;

                    exit;
                }

        }else{
                echo "Error cargando XML";
        }	
        
    } //fin de la funcion
     
    /*
    function test()
    {
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->helper('my_funciones_helper');
         
         $this->load->helper('lib.inc_helper');
       
        
        $var =$this->uri->segment(3);
        $cod_error =$this->uri->segment(4);
     //   var_dump($var1);exit();
        if($cod_error != FALSE)
        {
           $tipo_mensaje= "mensaje_error";
           $mensajes_visa = $this->model_wz->buscar_codvisa($cod_error);
           $msj= $mensajes_visa[0]->codvis_descripcion;
           $mensaje = " ERROR DE PAGO CON VISA </br> * Motivo : ".$msj;
        }else    
        { $tipo_mensaje= "";
           $mensaje = "";}

        $cliente= $this->model_wz->buscarcliente_x_id(3);
        
        if($this->input->post())//Codicional Tipo de Datos que Recibe
	{ 
                //$numPedido= $_POST["numPedido"];//'622';
                $plan = $this->model_wz->buscarplan_xid($this->input->post("plan",true));
                //$mount = number_format($plan[0]->mem_total,2);
                
                //var_dump($mount); 
                //var_dump($_POST); 
                //exit();
                
                $numPedido= 21;//'622';
		$codTienda = CODIGO_TIENDA;
		$mount = '1.00';
	
		//Se arma el XML de requerimiento
		$xmlIn = "";
		$xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
		$xmlIn = $xmlIn . "<nuevo_eticket>";
		$xmlIn = $xmlIn . "	<parametros>";
		$xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
		$xmlIn = $xmlIn . "		";
		$xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . $codTienda . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $numPedido . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" . $mount . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"DATO_COMERCIO\">JOSE</parametro>";
		$xmlIn = $xmlIn . "	</parametros>";
		$xmlIn = $xmlIn . "</nuevo_eticket>";
		
		//Se asigna la url del servicio
		//En producción cambiará la URL
		$servicio= URL_WSGENERAETICKET_VISA;
	//	var_dump($servicio);
		//Invocación al web service
               $client = new SoapClient($servicio);
               //var_dump($client);
                //print_r($client->GeneraEticket);
               
                //var_dump($client->__getFunctions());
		//exit;
		
                //parametros de la llamada
		$parametros=array(); 
		$parametros['xmlIn']= $xmlIn;
		//Aqui captura la cadena de resultado
		$result = $client->GeneraEticket($parametros);
		//Muestra la cadena recibida
		echo 'Cadena de respuesta: ' . $result->GeneraEticketResult . '<br>' . '<br>';
		
		//Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
		$xmlDocument = new DOMDocument();
		
		if ($xmlDocument->loadXML($result->GeneraEticketResult)){
			/////////////////////////[MENSAJES]////////////////////////
			//Ejemplo para determinar la cantidad de mensajes en el XML
			$iCantMensajes= $this->CantidadMensajes($xmlDocument);
			//echo 'Cantidad de Mensajes: ' . $iCantMensajes . '<br>';
			
			//Ejemplo para mostrar los mensajes del XML 
			for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++){
                            echo 'Mensaje #' . ($iNumMensaje +1) . ': ';
                            echo $this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
                            echo '<BR>';
			}
			/////////////////////////[MENSAJES]////////////////////////
			
			if ($iCantMensajes == 0){
                            $Eticket= $this->RecuperaEticket($xmlDocument);
                            echo 'Eticket: ' . $Eticket;

                            $html= htmlRedirecFormEticket($Eticket);
                            echo $html;

                            exit;
			}
					
		}else{
			echo "Error cargando XML";
		}	
        }//fin del post
        
        ///////////////////////TITULOS/////////////////////
        $this->layout->setTitle("SmartGamers - Registro de Usuarios");
        $this->layout->setSubTitle("Registro de Usuarios");
        ///////////////////////TITULOS/////////////////////
        $this->layout->view('step_3',compact("cliente","mensaje","tipo_mensaje"));
            
    }
    */
    function paginaRespuesta() 
    {
        $this->load->helper('lib.inc_helper');
        
        //Se asigna el Eticket
            $eTicket= $_POST["eticket"];
            
            //$eTicket= "0500870571721312052128083590"; // aprobado // cod 31
            //$eTicket= "0500870571721312052120057200"; // // cod 31
            //$eTicket= "0500870571721312052057440558"; //Autorizado
            //$eTicket= "0500870571721311292033005259"; //Autorizado
            //$eTicket= "0500870571721312051858538022"; // Autorizado //cod pedido vta : 29
            
            //$eTicket= "0500870571721311291650058693"; //Autorizado
            //$eTicket= "0500870571721311291851512249"; //Autorizado
            //$eTicket= "0500870571721312041145001205"; //Denegado // cod pedido vta : 21
            
            $codTienda = CODIGO_TIENDA;

            //Se arma el XML de requerimiento
            $xmlIn = "";
            $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
            $xmlIn = $xmlIn . "<consulta_eticket>";
            $xmlIn = $xmlIn . "	<parametros>";
            $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">";
            $xmlIn = $xmlIn . $codTienda;//Aqui se asigna el Cò£¨§o de tienda
            $xmlIn = $xmlIn . "</parametro>";
            $xmlIn = $xmlIn . "		<parametro id=\"ETICKET\">";
            $xmlIn = $xmlIn . $eTicket;//Aqui se asigna el eTicket
            $xmlIn = $xmlIn . "</parametro>";
            $xmlIn = $xmlIn . "	</parametros>";
            $xmlIn = $xmlIn . "</consulta_eticket>";

            //Se asigna la url del servicio
            //En producciò¬Ÿ£ambiarï¿½a URL
            $servicio= URL_WSCONSULTAETICKET_VISA; 

            //Invocaciò¬Ÿ¡l web service
            $client = new SoapClient($servicio);
            //print_r($client);
            //exit;
            //parametros de la llamada
            $parametros=array(); //parametros de la llamada
            $parametros['xmlIn']= $xmlIn;
            //Aqui captura la cadena de resultado
            $result = $client->ConsultaEticket($parametros);
                        
            //Muestra la cadena recibida
            //echo '<br><br>Cadena de respuesta: ' . $result->ConsultaEticketResult . '<br>' . '<br>';
            $cadaux = $result->ConsultaEticketResult;
            //Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
            $xmlDocument = new DOMDocument();
            //if ($xmlDocument->loadXML($result->ConsultaEticketResul)) 
            if ($xmlDocument->loadXML($cadaux)) 
            {
                    //Ejemplo para determinar la cantidad de operaciones 
                    //asociadas al Nï¿½ de pedido

                    $iCantOpe= $this->CantidadOperaciones($xmlDocument, $eTicket);
                    //echo '</br>Cantidad de Operaciones: ' . $iCantOpe . '<br>';

                    //Ejemplo para mostrar los parà¬¥tros de las operaciones
                    //asociadas al Nro de pedido
                    for($iNumOperacion=0;$iNumOperacion < $iCantOpe; $iNumOperacion++){
                            $this->PresentaResultado($xmlDocument, $iNumOperacion+1);
                    }

                    /*
                    //Ejemplo para determinar la cantidad de mensajes 
                    //asociadas al Nï¿½ de pedido
                    $iCantMensajes= $this->CantidadMensajes($xmlDocument);
                   // echo '<br><br>Cantidad de Mensajes: ' . $iCantMensajes . '<br>';

                    //Ejemplo para mostrar los mensajes de las operaciones
                    //asociadas al Nro de pedido
                    for($iNumMensaje=0;$iNumMensaje < $iCantMensajes; $iNumMensaje++){
                           // echo 'Mensaje #' . ($iNumMensaje +1) . ': ';
                           // echo $this->RecuperaMensaje($xmlDocument, $iNumMensaje+1);
                           // echo '<BR>';
                    }
                     * 
                     */
            }else{
                    //echo "Error";
                    show_404();
            }

    }//fin de funcion 
    
    //Funcion de ejemplo que obtiene la cantidad de operaciones
    function CantidadOperaciones($xmlDoc, $eTicket){
		$cantidaOpe= 0;
		$xpath = new DOMXPath($xmlDoc);
		$nodeList = $xpath->query('//pedido[@eticket="' . $eTicket . '"]', $xmlDoc);
              
		$XmlNode= $nodeList->item(0);
		//var_dump($XmlNode);exit();
		if($XmlNode==null){
			$cantidaOpe= 0;
		}else{
			$cantidaOpe= $XmlNode->childNodes->length;
		}
		return $cantidaOpe; 
	}

    //Funcion que recupera el valor de uno de los campos del XML de respuesta
    function RecuperaCampos($xmlDoc,$sNumOperacion,$nomCampo)
    {
                    $strReturn = "";

                    $xpath = new DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//operacion[@id='" . $sNumOperacion . "']/campo[@id='" . $nomCampo . "']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }
    //Funcion que muestra en pantalla los parámetros de cada operacion
    //asociada al Número de pedido consultado
    function PresentaResultado($xmlDoc, $iNumOperacion)
    {
                 
         $this->load->helper(array('form', 'url'));
         $this->load->helper('my_funciones_helper');
         
         
                    //ESTA FUNCION ES SOLAMENTE UN EJEMPLO DE COMO ANALIZAR LA RESPUESTA
                    $sNumOperacion = "";

                    $sNumOperacion = $iNumOperacion;

                    $strValor = "";
                    $strValor = $strValor . "Respuesta: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "respuesta") . "<BR>";
                    $strValor = $strValor . "cod_tienda: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_tienda") . "<BR>";
                    $strValor = $strValor . "nordent: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nordent") . "<BR>";
                    $strValor = $strValor . "cod_accion: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_accion") . "<BR>";
                    $strValor = $strValor . "pan: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "pan") . "<BR>";
                    $strValor = $strValor . "eci: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "eci") . "<BR>";
                    $strValor = $strValor . "cod_autoriza: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_autoriza") . "<BR>";
                    $strValor = $strValor . "ori_tarjeta: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "ori_tarjeta") . "<BR>";
                    $strValor = $strValor . "nom_emisor: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nom_emisor") . "<BR>";
                    $strValor = $strValor . "dsc_eci: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "dsc_eci") . "<BR>";
                    $strValor = $strValor . "cod_rescvv2: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_rescvv2") . "<BR>";
                    $strValor = $strValor . "imp_autorizado: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "imp_autorizado") . "<BR>";
                    $strValor = $strValor . "fechayhora_tx: " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "fechayhora_tx") . "<BR>";
                    $strValor = $strValor . "nombre_th -- : " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nombre_th") . "<BR>";
                    $strValor = $strValor . "Estado wz : " . $this->RecuperaCampos($xmlDoc, $sNumOperacion, "estado") . "<BR>";

  //                  echo($strValor);
 // exit();
                    $estado = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "estado");
                    $cod_rpta_visa = $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_accion");
                    
                    $fechaactual = date("Y-m-d H:i:s");
                    $nro_tarjeta= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "pan");
                    $cliente_tarj= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nombre_th");
                    $nom_emisor= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nom_emisor");
                    $nro_orden= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "nordent");
                    
                    if( $estado =="AUTORIZADO" AND $cod_rpta_visa =="000")
                    { // -- Pago exitoso  
                        
                        //$respuesta= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "respuesta");
                        
                        $cod_autoriza= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "cod_autoriza");
                        $imp_autorizado= $this->RecuperaCampos($xmlDoc, $sNumOperacion, "imp_autorizado");
                        
                    
                        //buscamos el nro de orden en la BD
                        $pedidovta = $this->model_wz->buscar_pedido_vta_xidped($nro_orden);
                        if($pedidovta != FALSE)
                        {   
                            $id_alquiler = $pedidovta[0]->id_alquiler;
                            
                            //PROCESO DE HABILITACION DE LA SUSCRIPCION EN BD
                            $estado_susc = $this->suscribir_cli($id_alquiler);
                                    
                            $tipo_mensaje =$estado_susc['tipo'];
                             if($tipo_mensaje=="mensaje_error") 
                              { //error de suscripcion pero si pago
                                 //diaparar mensaje para arreglar el estado del id_cliente
                                 $mensaje =$estado_susc['mensaje'];
                              }else
                              {
                                //actualizo el pedido de venta
                               
                                $consulta = $this->model_wz->consul_last_xidalq($id_alquiler);
                                $id_docventa = $consulta['0']['id_docventa'];
          
                                $data_formulario_tres =array(
                                  'id_docventa' => $id_docventa,
                                  'ped_estado' => 'aprobada',
                                  'ped_fechrpta' => $fechaactual,
                                  'ped_aprobado_por' => 'visa', 
                                  'ped_codautoriza_visa' => $cod_autoriza, 
                                  'ped_nrotarj_pago' => $nro_tarjeta, 
                                  'ped_nomcli_tarj' => $cliente_tarj, 
                                  'ped_bancoemisor' => $nom_emisor, 
                                  'ped_montoaprobado' => $imp_autorizado 
                                );          
                               
                                $this->model_wz->actualizar_pedidovta_xidped ($data_formulario_tres,$nro_orden);
                             
                                
                                $suscripcion = $this->model_wz->buscar_susc__xidpedvta($nro_orden);
                                $id_cliente = $suscripcion[0]->id_cliente;
                            
                                //redirigir al paso 4 todo OK.
                                redirect('registro/step_4final/'.$id_cliente);
                              }    
                        } //fin del $pedido != FALSE   
                        
                      // -- Fin Pago exitoso  
                    }else
                    { // -- Pago Fallido  
                    
                        $data_formulario_tres =array(
                            'ped_estado' => 'denegada',
                            'ped_fechrpta' => $fechaactual,
                            'ped_codautoriza_visa' => $cod_rpta_visa,
                            'ped_nrotarj_pago' => $nro_tarjeta, 
                            'ped_nomcli_tarj' => $cliente_tarj, 
                            'ped_bancoemisor' => $nom_emisor 
                          );     
                       
                        $this->model_wz->actualizar_pedidovta_xidped ($data_formulario_tres,$nro_orden);
                        
                        $suscripcion = $this->model_wz->buscar_susc__xidpedvta($nro_orden);
                        $id_cliente = $suscripcion[0]->id_cliente;
                        
                        $data_formulario_cont =array 
                        ( 'cli_estado' => 'paso2');

                        $this->model_wz->actualizar_cliente($data_formulario_cont,$id_cliente);
                         
                        //redirigir al paso 3 para que registre bien todos los datos.  
                        redirect(base_url().'registro/create_sus/'.$id_cliente.'/'.$cod_rpta_visa,  301);
                        
                       // -- Fin Pago Fallido    
                    } // fin del else    
                    
    } // fin de funcion PresentaResultado

    //Funcion de ejemplo que obtiene la cantidad de mensajes
    function CantidadMensajes($xmlDoc)
    {
            $cantMensajes= 0;
            $xpath = new DOMXPath($xmlDoc);
            $nodeList = $xpath->query('//mensajes', $xmlDoc);

            $XmlNode= $nodeList->item(0);

            if($XmlNode==null){
                    $cantMensajes= 0;
            }else{
                    $cantMensajes= $XmlNode->childNodes->length;
            }
            return $cantMensajes; 
    }
    //Funcion que recupera el valor de uno de los mensajes XML de respuesta
    function RecuperaMensaje($xmlDoc,$iNumMensaje)
    {
            $strReturn = "";

                    $xpath = new DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//mensajes/mensaje[@id='" . $iNumMensaje . "']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }

    //Funcion que recupera el valor del Eticket
    function RecuperaEticket($xmlDoc)
    {
            $strReturn = "";

                    $xpath = new DOMXPath($xmlDoc);
                    $nodeList = $xpath->query("//registro/campo[@id='ETICKET']");

                    $XmlNode= $nodeList->item(0);

                    if($XmlNode==null){
                            $strReturn = "";
                    }else{
                            $strReturn = $XmlNode->nodeValue;
                    }
                    return $strReturn;
    }
    
    
    function suscribir_cli($id_alquiler)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->helper('my_funciones_helper');
         
        $msj='';
        $tipo_mensaje="mensaje_error";

       
        //consultar los detalles del registro de alquiler
        $alquiler = $this->model_wz->busq_Suscripx_idalq($id_alquiler);
//var_dump($alquiler);        
        $id_membresia= $alquiler[0]->id_membresia;
        $id_cliente= $alquiler[0]->id_cliente;
        $nro_dias = $alquiler[0]->nro_dias;

        //consulto los detalles de venta para colocar en el doc venta
        $det_venta= $this->model_wz->consul_concep_xid_memb($id_membresia);
      
        $id_cove= $det_venta[0]->id_conceptoventa;
        $descr_venta= "Primera ".$det_venta[0]->cove_descripcion;
       
        $data_formulario_uno=array //DCTO de venta
        ( 'id_alquiler' => $id_alquiler,
          'docv_tipo' => 'boleta',
          'docv_montoneto' => $det_venta[0]->cove_precio,
          'docv_igv' => $det_venta[0]->cove_igv,
          'docv_montototal' => $det_venta[0]->cove_total,
          'docv_estado' => 'cerrado',
          'docv_estcobrado' => 'si'
         );
        //genero el dcto de venta a partir del id_alquiler
        $doc_vta = $this->model_wz->insert_newdoc($data_formulario_uno);
//var_dump($data_formulario_uno);

        if($doc_vta)
        { 
          $consulta = $this->model_wz->consul_last_xidalq($id_alquiler);
//var_dump($consulta);
          $id_docventa = $consulta['0']['id_docventa'];

          //genero el detalle del doc de venta
          $cant=1;
          $precioneto=$det_venta[0]->cove_total;//incluye el igv
          $total2 = (float)$cant*(float)$precioneto;
          $data_formulario_dos =array(
            'id_docventa'=>$id_docventa,
            'id_conceptoventa'=>$id_cove,
            'detdocv_cant'=>$cant,
            'detdocv_preciounit'=>$precioneto,
            'detdocv_subtotal'=>$total2,
            'detdocv_descripcion'=>$descr_venta
          );

          $detdoc_vta = $this->model_wz->insert_new_detdoc($data_formulario_dos);   
          
         if($detdoc_vta)
          {    
            //actualizar el estado y la fecha de inicio y determinar la fecha prox cargo del alquiler 
             $fecha_aux =  $sdate=date("d")."-".date("m")."-".date("Y");
             $nro_meses = $nro_dias/30;
             $prox_fecha=sumar_a_fecha($fecha_aux,'mes',$nro_meses);
             $prox_fecha =$prox_fecha." ".obtenerhora_actual();
             
            $data_formulario_3 = array(
               'alq_fechini' => obtenerfecha_hora(),
               'alq_fechfin' => $prox_fecha,
               'estado_alquiler' => 'activo'
            );
           $this->model_wz->actualizar_suscripcion($data_formulario_3,$id_alquiler);
            
            //actualizar el estado del cliente a suscrito
            $data_formulario_cont =array 
            ( 'cli_estado' => 'suscrito');
            
            $this->model_wz->actualizar_cliente($data_formulario_cont,$id_cliente);
            $msj='Se procedio a la suscripcion exitosa';   
            $tipo_mensaje="mensaje_exito";
          }else
          {    
            $msj.="<br>Error al generar detalles del documento de venta";
          }
        }   
        else
        {
            $msj.="<br>Error al generar documento de venta";
        }
        
      $data=array 
        (  'tipo'=>$tipo_mensaje,
           'mensaje'=>$msj
        );
        return $data;
       
    }//fin de funcion suscribir_cli
    
    function imprimir($id_ped,$id_alq )
    {
        $this->load->helper(array('form', 'url'));
        $this->load->helper('my_funciones_helper');
        $this->load->helper(array('dompdf', 'file'));   
        
        $id_ped= trim($id_ped);
        $id_alq= trim($id_alq);
        $ped= $this->model_wz->buscar_pedvta_xid_cli_idalq($id_ped,$id_alq);
        if($ped!=FALSE)
        {
            $nombre = "Comprobante de venta";
            $data['title']='PDF Printing';
            $data['cliente']=$this->model_wz->buscar_cli_idalq($id_alq);
            $data['ped_vta']=$ped;
            //$cliente =$this->model_wz->buscar_cli_idalq($id_alq);
            //$ped_vta=$ped;
            $html=$this->load->view('reportes/export_pdf/comprobante_suscripcion_pdf',$data,true);
            pdf_create($html, $nombre.date("m-d-Y H:i"));  
            //$this->load->view('reportes/export_pdf/comprobante_suscripcion_pdf',compact("cliente","ped_vta",true));
             
        }    
        
        
        
    }
   
        
    
}//fin de controller

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */