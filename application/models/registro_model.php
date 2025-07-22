<?php
class registro_model extends CI_Model {

    public function __construct(){
        $this->load->database();

    }

    public function registrar($info){
        $this->db->insert('registro', $info);
    }

    public function get_registros(){
        $query = $this->db->get('registro');
        return $query->result_array();
    }

    public function get_registro_usuario_logueado($usuario){
        $query = $this->db->get_where('registro', array('usuario' => $usuario));
        return $query->row_array();
    }

    
}

?>