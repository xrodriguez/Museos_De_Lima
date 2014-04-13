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

    

   

    
    /* =================================
     Modelos utilizados para las CIUDADES
     ===================================
    */
    function buscarciudad_xid($id)
    {
    $id=(int)$id;
    $this->db->where('id_categ',$id);
    $query=  $this->db->get('categoria');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
    
      function buscarcategoria_xid($id)
    {
    $id=(int)$id;
    $this->db->where('id_categ',$id);
    $query=  $this->db->get('categoria');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
    
   function actualizar_categoria($data=array(),$id)
    {
            $this->db->where('id_categ', $id);
            $this->db->update('categoria', $data);
            //echo $this->db->last_query();
             return TRUE;
    }
    function insertar_categoria($data=array())
    {
             $this->db->insert('categoria',$data);
             return true;
    }//fin  de la funcion inserttar

    
   function lista_museos_all($pagina,$porpagina,$quehago)
    {
            switch($quehago)
            {
                    case 'limit':
                            $query=$this->db
                            ->select("*")
                            ->from("museo")
                            ->order_by("Nombre", "asc")
                            ->limit($porpagina,$pagina)
                            ->get();
                            return $query->result();
                    break;
                    case 'cuantos':
                            $query=$this->db
                            ->select("*")
                            ->from("museo")
                            ->order_by("Nombre", "asc")
                            ->count_all_results();
                            return $query;
                    break;
            }   
    }//fin del modelo listar
    
    
   function lista_categorias_all($pagina,$porpagina,$quehago)
    {
            switch($quehago)
            {
                    case 'limit':
                            $query=$this->db
                            ->select("*")
                            ->from("categoria")
                            ->order_by("nombre", "asc")
                            ->limit($porpagina,$pagina)
                            ->get();
                            return $query->result();
                    break;
                    case 'cuantos':
                            $query=$this->db
                            ->select("*")
                            ->from("categoria")
                            ->order_by("nombre", "asc")
                            ->count_all_results();
                            
                            return $query;
                    break;
            }   
    }//fin del modelo listar
   function listar_categoria_habilitada()
    {
    $this->db->where('estado','habilitado');
    $query=  $this->db->get('categoria');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin de
    
     function insertar_museo($data=array())
    {
             $this->db->insert('museo',$data);
             return true;
    }//fin  de la funcion inserttar
    
    function actualizar_museo($data=array(),$id)
    {
            $this->db->where('id', $id);
            $this->db->update('museo', $data);
            //echo $this->db->last_query();
             return TRUE;
    }
  
      function buscarmuseo_xid($id)
    {
    $id=(int)$id;
    $this->db->where('id',$id);
    $query=  $this->db->get('museo');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin del modelo de formulario
   function listar_museos_habilitados()
    {
    $this->db->where('estado','habilitado');
    $query=  $this->db->get('museo');
    //echo $this->db->last_query();
     if($query->num_rows()>0){
       //sentencia que imprime la cadena sql enviada
        //echo $this->db->last_query();
         return $query->result();
     }else{
        return false;
     }
    }//fin de
    function lista_museos_hab_pag($pagina,$porpagina,$quehago)
    {
            switch($quehago)
            {
                    case 'limit':
                            $query=$this->db
                            ->select("*")
                            ->from("museo")
                            ->where("estado","habilitado")
                            ->order_by("nombre", "asc")
                            ->limit($porpagina,$pagina)
                            ->get();
                            return $query->result();
                    break;
                    case 'cuantos':
                            $query=$this->db
                            ->select("*")
                            ->from("museo")
                            ->where("estado","habilitado")
                            ->order_by("nombre", "asc")
                            ->count_all_results();
                            return $query;
                    break;
            }   
    }//fin del modelo listar
    
}//fin de la clase