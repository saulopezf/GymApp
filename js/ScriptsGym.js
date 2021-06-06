var horario = 1;

function formHorario(){
    if(horario<=5){
    document.getElementById('containerHorario').innerHTML += '<div class="form-row"><div class="col-md-6 mb-3"><label>Dia: </label><select name="diasSemana'+horario+'" id="diasSemana'+horario+'" class="form-control" required></select></div><div class="col-md-6 mb-3"><label>Horario: </label><select name="horario'+horario+'" id="horario'+horario+'" class="form-control" required></select></div></div>';
    selectDias("diasSemana"+horario);
    selectHorario("horario"+horario);
    horario++;
    }
    else{
        document.getElementById('nuevoHorario').style = "display:none;";
    }
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function selectHorario(id){
    for (var i = 8; i < 21; i++) {
        document.getElementById(id).innerHTML += "<option value='"+i+"'>"+i+":00 - "+(i+1)+":00</option>";
    }
}

function selectDias(id){
    var diasSemana = ["lunes","martes","miercoles","jueves","viernes","sabado","domingo",];
    for (var i = 0; i < diasSemana.length; i++) {
        document.getElementById(id).innerHTML += "<option value='"+diasSemana[i]+"'>"+capitalizeFirstLetter(diasSemana[i])+"</option>";  
    }
}

function selectMonitor(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            var monitores = JSON.parse(xhttp.responseText);
            mostrarMonitores(monitores);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=listaMonitores");
}

function mostrarMonitores(monitores){
    for (var i = 0; i < monitores.length; i++) {
        document.getElementById('monitorClase').innerHTML += "<option value='"+monitores[i]['dni']+"'>"+monitores[i]['nombre']+" "+monitores[i]['apellido']+" ("+monitores[i]['dni']+")</option>";    
    }
}

function escribirFooter(){
    document.getElementById('textoFooter').innerHTML = "Copyright &copy; "+new Date().getFullYear()+" Todos los derechos reservados | GymApp hecho por Saul Lopez Fernandez";
}

function escribirConsejos(){
    var suIMC = parseFloat(document.getElementById('imc').innerHTML); 
    var contenedor = document.getElementById('consejos');
    if(suIMC>35){
        contenedor.innerHTML = '<div class="alert alert-danger text-center" role="alert">¡Tiene un sobrepeso severo! Necsita tener una dieta muy ligera en grasas y hacer mucho cardio. Le recomendamos contactar con un nutricionista para poder realizar la dieta.</div>';
    }
    else if (suIMC>25){
        contenedor.innerHTML = '<div class="alert alert-warning text-center" role="alert">Sobrepeso. Le recomendamos un entrenamiento de definición para quemar esa grasa restante y definir su cuerpo.</div>';
    }
    else if (suIMC>=18.5){
        contenedor.innerHTML = '<div class="alert alert-success text-center" role="alert">¡Tiene un peso saludable! Sigue entrenando y come saludablemente para mantener un estado físico saludable.</div>';
    }
    else if (suIMC>=16){
        contenedor.innerHTML = '<div class="alert alert-warning text-center" role="alert">Delgadez. Le recomendamos un entrenamiento de volumen para poder subir de peso y asi estar en su peso saludable.</div>';
    }
    else if (suIMC>=0){
        contenedor.innerHTML = '<div class="alert alert-danger text-center" role="alert">¡Usted está en una delgadez muy severa! Ten una dieta rica en proteinas y carbohidratos mientras sigue entrenando. Una rutina de volumen le ayudará a subir peso.</div>';
    }
    else{
        contenedor.innerHTML = '';
    }
}

