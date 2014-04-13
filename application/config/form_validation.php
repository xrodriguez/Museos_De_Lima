<?php
$config=array(
			  /*
			  * Formulario
			  */
			  'items/add_items'
			  	=>array(
							array('field' => 'nombre', 'label' => 'Nombre', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'descCorta', 'label' => 'Descripcion', 'rules' => 'required|trim|validaSelect'),
							array('field' => 'plataforma', 'label' => 'Plataforma', 'rules' => 'required|validaSelect'),
							array('field' => 'distribuidor', 'label' => 'Distribuidor', 'rules' => 'required|validaSelect'),
							array('field' => 'desarrollador', 'label' => 'Desarrollador', 'rules' => 'required|validaSelect'),
							array('field' => 'formato', 'label' => 'Formato', 'rules' => 'required|validaSelect'),
							array('field' => 'generos[]', 'label' => 'Genero', 'rules' => 'required|validaSelect'),
							array('field' => 'stock', 'label' => 'Stock', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'video', 'label' => 'Video', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'archivo', 'label' => 'Archivo', 'rules' => 'trim')
						),
			'backend/form_plan'
				=>array(
							array('field' => 'descripcion', 'label' => 'Descripción', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'precio', 'label' => 'Precio', 'rules' => 'required|numeric|trim|xss_clean'),
							array('field' => 'igv', 'label' => 'igv', 'rules' => 'required|numeric|trim|xss_clean'),
							array('field' => 'total', 'label' => 'total', 'rules' => 'required|numeric|trim|xss_clean'),
							array('field' => 'max_item', 'label' => 'maximo de items', 'rules' => 'required|numeric|trim|xss_clean'),
							array('field' => 'nro_dias', 'label' => 'numero de dias', 'rules' => 'required|numeric|trim|xss_clean'),
							array('field' => 'visible', 'label' => 'Visibilidad para el cliente', 'rules' => 'trim|validaSelect'),
							array('field' => 'estado', 'label' => 'Estado', 'rules' => 'trim|validaSelect')	
							
						),
				'backend/form_clienteadmin'
				=>array(
							array('field' => 'nombres', 'label' => 'Nombres', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'apellidos', 'label' => 'Apellidos', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'sexo', 'label' => 'Sexo', 'rules' => 'required|is_string'),
							array('field' => 'dni', 'label' => 'Dni', 'rules' => 'required|numeric|trim|exact_length[8]'),
							array('field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email'),
							array('field' => 'telefono', 'label' => 'Telf. de Casa', 'rules' => 'trim'),
							array('field' => 'telefono2', 'label' => 'Telf. de Oficina', 'rules' => 'trim'),
							array('field' => 'anexo2', 'label' => 'Anex. ofic.', 'rules' => 'trim'),
							array('field' => 'celular', 'label' => 'Celular', 'rules' => 'trim|required|numeric|min_length[9]'),
							array('field' => 'dia', 'label' => 'Dia Nac.', 'rules' => 'trim|required|numeric'),
							array('field' => 'mes', 'label' => 'Mes  Nac.', 'rules' => 'trim|required|numeric'),
							array('field' => 'anio', 'label' => 'Año Nac.', 'rules' => 'trim|required|numeric'),
							array('field' => 'dir_envio', 'label' => 'Dirección envio', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'nro_envio', 'label' => 'Nro envio', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'dis_envio', 'label' => 'Distrito envio', 'rules' => 'trim|required'),
							array('field' => 'referencia', 'label' => 'Referencia envio', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'fac_direccion', 'label' => 'Dirección laboral', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'fac_nro', 'label' => 'Nro laboral', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'fac_distrito', 'label' => 'Distrito laboral', 'rules' => 'trim|required'),
							array('field' => 'fac_referencia', 'label' => 'Referencia laboral', 'rules' => 'trim|required|xss_clean'),
							array('field' => 'nro_tarjeta', 'label' => 'Nro de Tarjeta', 'rules' => 'trim|exact_length[16]|xss_clean'),
							array('field' => 'password', 'label' => 'Password', 'rules' => 'trim'),
							array('field' => 'repassword', 'label' => 'Confirmar password', 'rules' => 'trim|matches[password]')
							
						),
				//Final del array
    
    				'backend/mantenimiento_insert'
				=>array(
							array('field' => 'descripcion', 'label' => 'Descripcion', 'rules' => 'required|is_string|trim|xss_clean'),
							array('field' => 'estado', 'label' => 'Estado', 'rules' => 'required|validaSelect')
							
						)
				//Final del array
                                
				
			  )
?>