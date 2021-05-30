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

