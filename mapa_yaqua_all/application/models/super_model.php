<?php
class super_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /* =================================
     Modelos utilizados para las DISTRITOS
     ===================================
    */

    function lista_distritos_all($pagina,$porpagina,$quehago)
    {
            switch($quehago)
            {
                    case 'limit':
                            $query=$this->db
                            ->select("*")
                            ->from("distritos")
                            ->order_by("dis_descripcion", "asc")
                            ->limit($porpagina,$pagina)
                            ->get();
                            return $query->result();
                    break;
                    case 'cuantos':
                            $query=$this->db
                            ->select("*")
                            ->from("distritos")
                            ->order_by("dis_descripcion", "asc")
                            ->count_all_results();
                            return $query;
                    break;
            }   
    }//fin del modelo listar
    
    function listar_distritos_habilitadas()
    {
   $sql =' select dis.* ,ciu.ciu_descripcion ';
        $sql .=' FROM distritos as dis';
        $sql .=' INNER JOIN ciudad as ciu 
            ON dis.id_ciudad = ciu.id_ciudad AND dis.dis_estado ="habilitado"';
        
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if($query->num_rows()>0){
            //sentencia que imprime la cadena sql enviada
            //consulta de la tabla Users
            return $query->result();
        }else{
            return false;
        }
    }//fin del modelo de formulario
    
    function buscardistrito_xid($id)
    {
    $id=(int)$id;
    $this->db->where('id_distrito',$id);
    $query=  $this->db->get('distritos');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
    

   

    function actualizar_distrito($data=array(),$id)
    {
            $this->db->where('id_distrito', $id);
            $this->db->update('distritos', $data); 
             return TRUE;
    } //fin de funcion actualizar

    function insertar_distrito($data=array())
    {
             $this->db->insert('distritos',$data);
             return true;
    }//fin  de la funcion inserttar

    
    /* =================================
     Modelos utilizados para las CIUDADES
     ===================================
    */
    
   function listar_ciudades_habilitadas()
    {
    $this->db->where('ciu_estado','habilitado');
    $query=  $this->db->get('ciudad');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
    
   function lista_ciudades_all($pagina,$porpagina,$quehago)
    {
            switch($quehago)
            {
                    case 'limit':
                            $query=$this->db
                            ->select("*")
                            ->from("ciudad")
                            ->order_by("ciu_descripcion", "asc")
                            ->limit($porpagina,$pagina)
                            ->get();
                            return $query->result();
                    break;
                    case 'cuantos':
                            $query=$this->db
                            ->select("*")
                            ->from("ciudad")
                            ->order_by("ciu_descripcion", "asc")
                            ->count_all_results();
                            return $query;
                    break;
            }   
    }//fin del modelo listar

    function buscarciudad_xid($id)
    {
    $id=(int)$id;
    $this->db->where('id_ciudad',$id);
    $query=  $this->db->get('ciudad');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
    

   

    function actualizar_ciudad($data=array(),$id)
    {
            $this->db->where('id_ciudad', $id);
            $this->db->update('ciudad', $data); 
             return TRUE;
    } //fin de funcion actualizar

    function insertar_ciudad($data=array())
    {
             $this->db->insert('ciudad',$data);
             return true;
    }//fin  de la funcion inserttar 
    
}//fin de la clase