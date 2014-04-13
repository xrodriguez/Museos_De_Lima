<?php
class login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	public function logueo($login,$pass)
	{
		$query=$this->db
		->select("id_usuario, user_nombres, user_apellidos, user_direccion, user_username, user_password, user_tipo, user_nivel, user_dni, user_email, user_telefono, user_celular")
		->from("usuario")
		->where(array("user_username"=>$login,"user_password"=>$pass))
		->get();
		//echo $this->db->last_query();
		return $query->row();
	}
}