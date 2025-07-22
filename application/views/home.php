<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form id="regForm" method="POST" action="<?php echo base_url();?>welcome/formulario" >
                <h1 id="register">Call Center</h1>
                <div class="all-steps" id="all-steps"> <span class="step"></span> </div>
                <div class="tab">

                    <label> Cédula (sin puntos ni guiones) </label>
                    <p><input placeholder="" oninput="this.className = ''" name="cedula" id="cedula"></p>
                    
                    <label> Número de telefono </label>
                    <p><input placeholder="" oninput="this.className = ''" name="telefono" id="telefono"></p>

                    <label> Nombre</label>
                    <p><input placeholder="" oninput="this.className = ''" name="nombre" id="nombre"></p>

                    <label> Apellido </label>
                    <p><input placeholder="" oninput="this.className = ''" name="apellido" id="apellido"></p>

                    <label> Dirección </label>
                    <select class="form-select mb-2" aria-label="Default select example" name="direccion">
                        <option value="Administración general" selected>Administración general</option>
                        <option value="Administracion de hacienda">Administracion de hacienda</option>
                        <option value="Gestión ambiental y salud">Gestión ambiental y salud</option>
                        <option value="Obra y vialidad">Obra y vialidad</option>
                        <option value="Paseos públicos y alumbrado">Paseos públicos y alumbrado</option>
                        <option value="Cultura y educación">Cultura y educación</option>
                        <option value="Transito, movilidad y seguridad">Transito, movilidad y seguridad</option>
                        <option value="Descentralización">Descentralización</option>
                        <option value="Desarrollo">Desarrollo</option>
                        <option value="Deporte">Deporte</option>
                        <option value="Políticas sociales">Políticas sociales</option>
                        <option value="Innovación y tecnología">Innovación y tecnología</option>
                        <option value="Planificación territorial">Planificación territorial</option>
                        <option value="Escuela de gobernanza">Escuela de gobernanza</option>
                        <option value="Turismo">Turismo</option>
                    </select>

                    <label> Tipo </label>
                    <label class="container"> Reclamo
                            <input type="radio" checked="checked" value="Reclamo" name="tipo">
                            <span class="checkmark"></span>
                    </label>
                    <label class="container"> Información
                            <input type="radio" name="tipo" value="Información">
                            <span class="checkmark"></span>
                    </label>
                    <label class="container"> Otras
                            <input type="radio" name="tipo" value="Otras">
                            <span class="checkmark"></span>
                    </label>
        
                    <label> Fin o deriva </label>
                    <label class="container"> Fin
                            <input type="radio" name="finDeriva" value="Fin" checked="checked">
                            <span class="checkmark"></span>
                    </label>
                    <label class="container"> Deriva
                            <input type="radio" name="finDeriva" value="Deriva">
                            <span class="checkmark"></span>
                    </label>

                    <label> Motivo</label>
                    <textarea class="form-control mb-3" rows="5" name="motivo"></textarea>

                    

                </div>
                
                <div class="alert alert-danger text-center" role="alert" id="error-cedula">
                    La cédula ingresada no es valida, recuerda que debe ser sin puntos ni guiones.
                </div>
                        
                <div class="d-flex justify-content-center align-items-center" id="nextprevious">
                    <button type="submit" id="finalizar">Finalizar</button> 
                </div>
            </form>
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

<style>
/* your CSS goes here*/
body {
    background: #eee
}

#regForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 40px;
    border-radius: 10px
}

h1 {
    text-align: center
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa
}

input.invalid {
    background-color: #ffdddd
}

.tab {
    display: block
}

button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

#prevBtn {
    background-color: #bbbbbb
}

.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #4CAF50;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5
}

.step.active {
    opacity: 1
}

.step.finish {
    background-color: #4CAF50
}

.all-steps {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 30px
}

.thanks-message {
    display: none
}

.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


/* Hide the browser's default radio button */

.container input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}


/* Create a custom radio button */

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}


/* On mouse-over, add a grey background color */

.container:hover input~.checkmark {
    background-color: #ccc;
}


/* When the radio button is checked, add a blue background */

.container input:checked~.checkmark {
    background-color: #2196F3;
}


/* Create the indicator (the dot/circle - hidden when not checked) */

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}


/* Show the indicator (dot/circle) when checked */

.container input:checked~.checkmark:after {
    display: block;
}


/* Style the indicator (dot/circle) */

.container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}


.tab{
    zoom: 100%
}

#error-cedula{
    display: none;
}
</style>