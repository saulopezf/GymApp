var dniRegex = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
var mailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
var noNumber = /^([^0-9]*)$/;
var tlfnoRegex = /(\+34|0034|34)?[ -]*(5|6|7|8|9)[ -]*([0-9][ -]*){8}/;

var dniCorrecto=false;
var nombreCorrecto=false;
var apeCorrecto=false;
var tlfnoCorrecto=false;
var mailCorrecto=false;
var usuCorrecto=false;
var passCorrecto=false;
var monitorCorrecto=false;
var passValidado=false;
var horarioCorrecto=true;

var horarios;

function updateTlfno(){
	validarTlfno(document.getElementById('tlfnoRegistro').value,document.getElementById('tlfnoRegistro'));
	compararPass(document.getElementById('passwordTlfno').value,document.getElementById('passwordTlfno'));
	if(tlfnoCorrecto&&passValidado){
		return true;
	}
	else{
		return false;
	}
}

function updateMail(){
	validarMail(document.getElementById('mailRegistro').value,document.getElementById('mailRegistro'));
	compararPass(document.getElementById('passwordMail').value,document.getElementById('passwordMail'));
	if(mailCorrecto&&passValidado){
		return true;
	}
	else{
		return false;
	}
	
}

function updatePass(){
	validarPass(document.getElementById('passRegistro').value,document.getElementById("formPass").elements.namedItem("newpassword").value,document.getElementById('passRegistro'));
	compararPass(document.getElementById('passwordPass').value,document.getElementById('passwordPass'));
	if(passCorrecto&&passValidado){
		return true;
	}
	else{
		return false;
	}
	
}

function updateMonitor(){
	validarMonitor(document.getElementById('monitorClase').value,document.getElementById('monitorClase'));
	if(monitorCorrecto){
		return true;
	}
	else{
		return false;
	}
}

function updateHora(){
	validarHorarios(document.getElementById('dia').value,document.getElementById('dia'),document.getElementById('horario').value,document.getElementById('horario'));
	if(horarioCorrecto){
		return true;
	}
	else{
		return false;
	}
}



function validarFormulario(){
		validarElementos();
		if(dniCorrecto&&nombreCorrecto&&apeCorrecto&&tlfnoCorrecto&&mailCorrecto){
			return true;
		}
		else{

			document.getElementById('errorVali').innerHTML="<div class='alert alert-danger text-center'>Por favor, rellene los campos incorrectos o vacios</div>";
			return false;
			
		}
}

function validarNuevaClase(){
	validarNombre(document.getElementById('nombreClase').value,document.getElementById('nombreClase'));
	validarMonitor(document.getElementById('monitorClase').value,document.getElementById('monitorClase'));
	var i=0;
	do{
		validarHorarios(document.getElementById('diasSemana'+i).value,document.getElementById('diasSemana'+i),document.getElementById('horario'+i).value,document.getElementById('horario'+i));
		i++;
	}while(i<horario&&horarioCorrecto);
	console.log(nombreCorrecto+""+monitorCorrecto+""+horarioCorrecto);
	if(nombreCorrecto&&monitorCorrecto&&horarioCorrecto){
		return true;
	}
	else{
		return false;	
	}
}

function getHorarios(){
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
            horarios = JSON.parse(xhttp.responseText);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=horarios");
}

function validarHorarios(dia,diaId,horaInicio,horaInicioId){
	var contadorMal = 0;
	for(var indice in horarios){
		horaInicioParse = (horarios[indice]['horaInicio']).slice(0,3);
		if(horaInicioParse.charAt(0)=="0"){
			horaInicioParse = horaInicioParse.slice(1);
		}
		if(dia == horarios[indice]['dia']&&horaInicio==parseInt(horaInicioParse)){
			contadorMal++;
		}
	}
	if(contadorMal==0){
		esValido(diaId);
		esValido(horaInicioId);
		document.getElementById('errorVali').innerHTML="";
		horarioCorrecto=true;
	}
	else{
		document.getElementById('errorVali').innerHTML="<div class='alert alert-danger text-center'>Este horario ya esta cogido</div>";
		noEsValido(diaId);
		noEsValido(horaInicioId);
		horarioCorrecto=false;
	}
}

function compararPass(pass,getId){
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            var passCoincide = xhttp.responseText;
            if(passCoincide){
            	esValido(getId);
				passValidado=true;
            }
            else{
            	noEsValido(getId);
            }
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=validarPass&password="+pass);
}

function validarMonitor(monitor,getId){
	if(monitor=="seleccionar"){
		noEsValido(getId);
	}
	else{
		esValido(getId);
		monitorCorrecto=true;
	}
}

function validarElementos(){
	validarDNI(document.getElementById('dniRegistro').value,document.getElementById('dniRegistro'));
	validarNombre(document.getElementById('nombreRegistro').value,document.getElementById('nombreRegistro'));
	validarApellidos(document.getElementById('apeRegistro').value,document.getElementById('apeRegistro'));
	validarMail(document.getElementById('mailRegistro').value,document.getElementById('mailRegistro'));
	validarTlfno(document.getElementById('tlfnoRegistro').value,document.getElementById('tlfnoRegistro'));
}

function esValido(getId){
	if (getId.classList.contains('is-invalid')) {
		getId.classList.remove('is-invalid');
	}
}

function noEsValido(getId){
	getId.classList.add('is-invalid');
}


function validarDNI(dni,getId){
	if(!dniRegex.test(dni)){
		noEsValido(getId);
	}
	else{
		dniCorrecto=true;
		esValido(getId);
	}
	
}

function validarNombre(nombre,getId){
	if(!noNumber.test(nombre)){
		noEsValido(getId);
	}
	else{
		nombreCorrecto=true;
		esValido(getId);
	}
}

function validarApellidos(apellido,getId){
	if(!noNumber.test(apellido)){
		noEsValido(getId);
	}
	else{
		apeCorrecto=true;
		esValido(getId);
	}
}

function validarMail(mail,getId){
	if(!mailRegex.test(mail)){
		noEsValido(getId);
	}
	else{
		mailCorrecto=true;
		esValido(getId);
	}
}

function validarTlfno(tlfno,getId){
	if(!tlfnoRegex.test(tlfno)){
		noEsValido(getId);
	}
	else{
		tlfnoCorrecto=true;
		esValido(getId);
	}		
}


function validarPass(pass,passComparar,getId){
	if(pass!=passComparar){
		noEsValido(getId);
	}
	else{
		passCorrecto=true;
		esValido(getId);
	}		
}
