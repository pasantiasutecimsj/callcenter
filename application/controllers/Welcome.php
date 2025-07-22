<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// Login o home si ya esta logueado
    public function index()
	{
		if($this->session->userdata('usuario')){
			$this->load->view('layout/header');
			$this->load->view('layout/navbar');
			$this->load->view('home');
		}
		else{
			$this->load->view('layout/header');
			$this->load->view('login');
		}
		
	}

    // Login
    public function login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('auth_model');

		$usuario = $this->auth_model->login($username, $password);

		if($usuario){
			$this->session->set_userdata('usuario', $usuario["username"]);
			$this->session->set_userdata('admin', $usuario["admin"]);
			redirect('welcome');
		}
		else{
			$this->session->set_flashdata('error', 'Usuario o contraseña incorrectos');
			redirect('welcome');
		}	
    }

    // Logout
    public function logout()
    {
        $this->session->unset_userdata('usuario');
		session_destroy();
		redirect('welcome');
    }

	public function formulario(){
		$telefono = $this->input->post('telefono');
		$cedula = $this->input->post('cedula');
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$direccion = $this->input->post('direccion');
		$tipo = $this->input->post('tipo');
		$finDeriva = $this->input->post('finDeriva');
		$motivo = $this->input->post('motivo');

		$fecha = date("Y-m-d");
		$hora = date("H:i:s");

		$this->load->model('registro_model');
		$this->load->model("persona_model");

		$info = array(
			'cedula' => $cedula,
			'direccion' => $direccion,
			'tipo' => $tipo,
			'fecha' => $fecha,
			'hora' => $hora,
			'finDeriva' => $finDeriva,
			'motivo' => $motivo,
			'usuario' => $this->session->userdata('usuario')
		);
		
		$this->registro_model->registrar($info);

		// Registro a la persona en caso de no estar registrada

		/* if($this->persona_model->existe_persona($cedula)){
			// La persona ya existe, actualizo sus datos
			$this->persona_model->registrar_persona($cedula, $nombre, $apellido, $telefono);
		}
		else{
			// La persona no existe, la registro
			$this->persona_model->registrar_persona($cedula, $nombre, $apellido, $telefono);
		} */
		// Esto es codigo viejo, ya no funciona ni hace falta. Registrar persona hace createOrUpdate a la nueva API

		$this->persona_model->registrar_persona($cedula, $nombre, $apellido, $telefono);

		redirect("welcome/exito");
	}


	public function exito(){
		$this->load->view('layout/header');
		$this->load->view('layout/navbar');
		$this->load->view('exito');
	}


	public function usuarios(){
		if($this->session->userdata('admin') == 1){
			$this->load->model('auth_model');
			$usuarios = $this->auth_model->get_usuarios();
			$data['usuarios'] = $usuarios;
			$this->load->view('layout/header');
			$this->load->view('layout/navbar');
			$this->load->view('usuarios', $data);
		}
		else{
			redirect('welcome');
		}
	}


	public function nuevo_usuario(){
		if($this->session->userdata('admin') == 1){

			$this->load->model('auth_model');

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password2 = $this->input->post('password2');
			$admin = $this->input->post('admin');

			if(!$username || !$password || !$password2){
				$this->session->set_flashdata('error', 'Debes completar todos los campos');
				redirect('welcome/usuarios');
			}

			if($this->auth_model->existe_usuario($username)){
				$this->session->set_flashdata('error', 'Ya existe un usuario con ese username');
				redirect('welcome/usuarios');
			}

			if($password != $password2){
				$this->session->set_flashdata('error', 'Las contraseñas no coinciden');
				redirect('welcome/usuarios');
			}

			$this->auth_model->registrar_usuario($username, $password, $admin);

			$this->session->set_flashdata("success", "Usuario registrado con éxito");
			redirect('welcome/usuarios');


		}
		else{
			redirect('welcome');
		}
	}


	public function eliminar_usuario(){
		if($this->session->userdata('admin') == 1){

			$username = $this->input->post('username');
			$this->load->model('auth_model');
			$this->auth_model->eliminar_usuario($username);
			$this->session->set_flashdata("success", "Usuario eliminado con éxito");
			redirect('welcome/usuarios');
		}
		else{
			redirect('welcome');
		}
	}


	public function get_persona(){
		
		$ci = $this->input->post('ci');

		if($this->validarCedula($ci) == false){
			header('valida: NO');
			echo json_encode(false);
			return;
		}
		else{
			header('valida: SI');
			$this->load->model('persona_model');
	
			$persona = $this->persona_model->get_persona($ci);
			echo json_encode($persona);
		}

	}


	function validarCedula($CedulaDeIdentidad) {

        // si la cedula contiene . o - retorno false
        if (strpos($CedulaDeIdentidad, '.') !== false || strpos($CedulaDeIdentidad, '-') !== false) {
            return false;
        }

        $regexCI = '/^([0-9]{1}[.]?[0-9]{3}[.]?[0-9]{3}[-]?[0-9]{1}|[0-9]{3}[.]?[0-9]{3}[-]?[0-9]{1})$/';

        if (!preg_match($regexCI, $CedulaDeIdentidad)) {
            return false;
        } else {
            // Limpiamos los puntos y guiones para solo quedarnos con los números.
            $numeroCedulaDeIdentidad = preg_replace("/[^0-9]/","",$CedulaDeIdentidad);

            // Armarmos el array que va a permitir realizar las multiplicaciones necesarias en cada digito.
            $arrayCoeficiente = [2,9,8,7,6,3,4,1];

            // Variable donde se va a guardar el resultado de la suma.
            $suma = 0;

            // Simplemente para que se entienda que esto es el cardinal de digitos que tiene el array de coeficiente.
            $lenghtArrayCoeficiente = 8;

            // Contamos la cantidad de digitos que tiene la cadena de números de la CI que limpiamos.
            $lenghtCedulaDeIdentidad = strlen($numeroCedulaDeIdentidad);

            // Esto nos asegura que si la cédula es menor a un millón, para que el cálculo siga funcionando, simplemente le ponemos un cero antes y funciona perfecto.
            if ($lenghtCedulaDeIdentidad == 7) {
                $numeroCedulaDeIdentidad = 0 . $numeroCedulaDeIdentidad;
                $lenghtCedulaDeIdentidad++;
            }

            for ($i = 0; $i < $lenghtCedulaDeIdentidad; $i++) {
                // Voy obteniendo cada caracter de la CI.
                $digito = substr($numeroCedulaDeIdentidad, $i, 1);

                // Ahora lo forzamos a ser un int.
                $digitoINT = intval($digito);

                // Obtengo el coeficiente correspondiente a esta posición.
                $coeficiente = $arrayCoeficiente[$i];

                // Multiplico el caracter por el coeficiente y lo acumulo a la suma total
                $suma = $suma + $digitoINT * $coeficiente;
            }

            // si la suma es múltiplo de 10 es una ci válida
            if (($suma % 10) == 0) {
                return true;
            } else {
                return false;
            }		
        }
    }        
}
