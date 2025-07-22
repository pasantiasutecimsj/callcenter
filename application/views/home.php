<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-xl-6">
      <div class="card shadow-lg p-4 rounded-4">
        <h2 class="text-center mb-4 text-azul fw-bold">Formulario de Contacto</h2>

        <form id="regForm" method="POST" action="<?php echo base_url();?>welcome/formulario">

          <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control input-focus" id="cedula" name="cedula" required>
          </div>

          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control input-focus" id="telefono" name="telefono" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control input-focus" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control input-focus" id="apellido" name="apellido" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <select class="form-select input-focus" name="direccion">
              <option selected disabled>Seleccione una dirección</option>
              <option value="Administración general">Administración general</option>
              <option value="Administracion de hacienda">Administración de hacienda</option>
              <option value="Gestión ambiental y salud">Gestión ambiental y salud</option>
              <option value="Obra y vialidad">Obra y vialidad</option>
              <option value="Paseos públicos y alumbrado">Paseos públicos y alumbrado</option>
              <option value="Cultura y educación">Cultura y educación</option>
              <option value="Transito, movilidad y seguridad">Tránsito, movilidad y seguridad</option>
              <option value="Descentralización">Descentralización</option>
              <option value="Desarrollo">Desarrollo</option>
              <option value="Deporte">Deporte</option>
              <option value="Políticas sociales">Políticas sociales</option>
              <option value="Innovación y tecnología">Innovación y tecnología</option>
              <option value="Planificación territorial">Planificación territorial</option>
              <option value="Escuela de gobernanza">Escuela de gobernanza</option>
              <option value="Turismo">Turismo</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Tipo</label>
            <div class="radio-group">
                <label class="custom-radio">
                <input type="radio" name="tipo" value="Reclamo" checked>
                <span class="radio-mark"></span>
                Reclamo
                </label>
                <label class="custom-radio">
                <input type="radio" name="tipo" value="Información">
                <span class="radio-mark"></span>
                Información
                </label>
                <label class="custom-radio">
                <input type="radio" name="tipo" value="Otras">
                <span class="radio-mark"></span>
                Otras
                </label>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Fin o Deriva</label>
            <div class="radio-group">
                <label class="custom-radio">
                <input type="radio" name="finDeriva" value="Fin" checked>
                <span class="radio-mark"></span>
                Fin
                </label>
                <label class="custom-radio">
                <input type="radio" name="finDeriva" value="Deriva">
                <span class="radio-mark"></span>
                Deriva
                </label>
            </div>
          </div>

          <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <textarea class="form-control input-focus" id="motivo" name="motivo" rows="4"></textarea>
          </div>

          <div class="alert alert-danger text-center d-none" id="error-cedula">
            La cédula ingresada no es válida.
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-login">Finalizar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
    



    document.getElementById("cedula").addEventListener("focusout", buscar_persona);

    function buscar_persona(){

        document.getElementById("nombre").value = "";
        document.getElementById("apellido").value = "";
        document.getElementById("telefono").value = "";

        var cedula = document.getElementById("cedula").value;
        var http = new XMLHttpRequest();
        http.open("POST", "<?php echo base_url();?>welcome/get_persona", true);
        
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send("ci="+cedula);
        
        http.onload = function() {
           
            var result = http.responseText;
         
            if(result == null || result == false){ 
                document.getElementById("nombre").value = "";
                document.getElementById("apellido").value = "";
                document.getElementById("telefono").value = "";
            }
            else{
                var obj = JSON.parse(result);
                if(obj){
                    obj.nombre == undefined ? document.getElementById("nombre").value = "" : document.getElementById("nombre").value = obj.nombre;
                    obj.apellido == undefined ? document.getElementById("apellido").value = "" : document.getElementById("apellido").value = obj.apellido;
                    obj.telefono == undefined ? document.getElementById("telefono").value = "" : document.getElementById("telefono").value = obj.telefono;            
                }
            }

            let valida = http.getResponseHeader("valida");
            if(valida == "NO"){
                document.getElementById("error-cedula").style.display = "block";
                document.getElementById("finalizar").style.display = "none";

            }
            else{
                document.getElementById("error-cedula").style.display = "none";
                document.getElementById("finalizar").style.display = "block";
            }   
            
        }
    }



</script>