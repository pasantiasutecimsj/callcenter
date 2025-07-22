<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegistroPersonas
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:4020';
    }

// PERSONAS
    public function getPersonas()
    {
        return $this->get('/personas');
    }

    public function getPersona($ci)
    {
        return $this->get('/personas/' . $ci);
    }

    public function createPersona($data)
    {
        return $this->post('/personas', $data);
    }

    public function updatePersona($id, $data)
    {
        return $this->put('/personas/' . $id, $data);
    }

    public function patchPersona($id, $data)
    {
        return $this->patch('/personas/' . $id, $data);
    }

    public function deletePersona($id)
    {
        return $this->delete('/personas/' . $id);
    }

    public function updateOrCreatePersona($data)
    {
        return $this->post('/personas/updateOrCreate', $data);
    }

// ORGANIZACIONES
    public function getOrganizaciones()
    {
        return $this->get('/organizaciones');
    }

    public function getOrganizacion($id)
    {
        return $this->get('/organizaciones/' . $id);
    }

    public function createOrganizacion($data)
    {
        return $this->post('/organizaciones', $data);
    }

    public function updateOrganizacion($id, $data)
    {
        return $this->put('/organizaciones/' . $id, $data);
    }

    public function patchOrganizacion($id, $data)
    {
        return $this->patch('/organizaciones/' . $id, $data);
    }

    public function deleteOrganizacion($id)
    {
        return $this->delete('/organizaciones/' . $id);
    }

// CIUDADES
    public function getCiudades()
    {
        return $this->get('/ciudades');
    }

    public function getCiudad($id)
    {
        return $this->get('/ciudades/' . $id);
    }

    public function getCiudadByNombre($nombre)
    {
        return $this->get('/ciudades/nombre/' . $nombre);
    }

    public function createCiudad($data)
    {
        return $this->post('/ciudades', $data);
    }

    public function updateCiudad($id, $data)
    {
        return $this->put('/ciudades/' . $id, $data);
    }

    public function patchCiudad($id, $data)
    {
        return $this->patch('/ciudades/' . $id, $data);
    }

    public function deleteCiudad($id)
    {
        return $this->delete('/ciudades/' . $id);
    }

// DIRECCIONES
    public function getDirecciones()
    {
        return $this->get('/direcciones');
    }

    public function getDireccionesFullData()
    {
        return $this->get('/direcciones/full');
    }

    public function getDireccion($id)
    {
        return $this->get('/direcciones/' . $id);
    }

    public function getDireccionesByPersona($ci)
    {
        return $this->get('/direcciones/persona/' . $ci);
    }

    public function getDireccionesByOrganizacion($id)
    {
        return $this->get('/direcciones/organizacion/' . $id);
    }

    public function buscarDireccion($filtros)
    {
        return $this->post('/direcciones/buscar', $filtros);
    }

    public function createDireccionConPersona($data)
    {
        return $this->post('/direcciones/crear/persona', $data);
    }

    public function createDireccionConOrganizacion($data)
    {
        return $this->post('/direcciones/crear/organizacion', $data);
    }

    public function updateDireccion($id, $data)
    {
        return $this->put('/direcciones/' . $id, $data);
    }

    public function patchDireccion($id, $data)
    {
        return $this->patch('/direcciones/' . $id, $data);
    }

    public function updatePersonaDireccion($id, $data)
    {
        return $this->put('/direcciones/persona-direccion/' . $id, $data);
    }

    public function patchPersonaDireccion($id, $data)
    {
        return $this->patch('/direcciones/persona-direccion/' . $id, $data);
    }

    public function deleteDireccion($id)
    {
        return $this->delete('/direcciones/' . $id);
    }

    public function deletePersonaDireccion($id)
    {
        return $this->delete('/direcciones/persona-direccion/' . $id);
    }


// Métodos HTTP básicos
    private function get($uri)
    {
        return $this->call('GET', $uri);
    }

    private function post($uri, $data)
    {
        return $this->call('POST', $uri, $data);
    }

    private function put($uri, $data)
    {
        return $this->call('PUT', $uri, $data);
    }

    private function patch($uri, $data)
    {
        return $this->call('PATCH', $uri, $data);
    }

    private function delete($uri)
    {
        return $this->call('DELETE', $uri);
    }

// LLAMADO Y RETURN
    private function call($method, $uri, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        if ($data !== null) {
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload)
            ));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        log_message('debug', 'ESTE ES EL REPONSE ATENTOOOOOOOOOOOOOOOOO!!!!!!!!!!!!!!!!!!!!!!!!!!. res: ' . $response);

        return json_decode($response, true); // o simplemente return $response;
    }
}