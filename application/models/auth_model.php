<?php
class auth_model extends CI_Model {

    public function __construct(){
        $this->load->database();

    }

    public function login($usuario, $password){
        $query = $this->db->get_where('usuario', array('username' => $usuario));
        $usuario = $query->row_array();

        if($usuario){
            if(password_verify($password, $usuario['password'])){
                return $usuario;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }


    public function get_usuarios(){
        $query = $this->db->get('usuario');
        return $query->result_array();
    }


    public function existe_usuario($username){

        $query = $this->db->get_where('usuario', array('LOWER(username)' => strtolower($username)));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function eliminar_usuario($username){
        $this->db->delete('usuario', array('username' => $username));
    }


    public function registrar_usuario($username, $password, $admin){
        $this->db->insert('usuario', array('username' => $username, 'password' => password_hash($password, PASSWORD_BCRYPT), 'admin' => $admin));
    }

    
}

?>