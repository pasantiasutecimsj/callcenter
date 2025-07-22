<?php
class persona_model extends CI_Model {

    public function __construct(){
        $this->load->library('RegistroPersonas');
    }

    public function registrar_persona($ci, $nombre, $apellido, $telefono){
        $data = array(
            'ci' => $ci,
            'nombre'   => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono
        );


        return $this->registropersonas->updateOrCreatePersona($data);
    }

    public function actualizar_persona($ci, $nombre, $apellido, $telefono){
        $data = array(
            'nombre'   => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono
        );

        return $this->registropersonas->updatePersona($ci, $data);
    }

    public function get_persona($ci){
        return $this->registropersonas->getPersona($ci);
    }

    public function existe_persona($ci){
        $persona = $this->registropersonas->getPersona($ci);
        return !empty($persona);
    }
}
?>