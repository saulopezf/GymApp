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


function validarFormulario(){
		validarElementos();
		if(dniCorrecto&&nombreCorrecto&&apeCorrecto&&tlfnoCorrecto&&mailCorrecto&&passCorrecto){
			return true;
		}
		else{

			document.getElementById('errorVali').innerHTML="<div class='alert alert-danger text-center'>Por favor, rellene los campos incorrectos o vacios</div>";
			return false;
			
		}
}

function validarElementos(){
	validarDNI(document.getElementById('dniRegistro').value,document.getElementById('dniRegistro'));
	validarNombre(document.getElementById('nombreRegistro').value,document.getElementById('nombreRegistro'));
	validarApellidos(document.getElementById('apeRegistro').value,document.getElementById('apeRegistro'));
	validarMail(document.getElementById('mailRegistro').value,document.getElementById('mailRegistro'));
	validarTlfno(document.getElementById('tlfnoRegistro').value,document.getElementById('tlfnoRegistro'));
	validarPass(document.getElementById('passRegistro').value,document.getElementById('passRegistro'));
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


		function validarPass(pass,getId){
				if(pass!=document.getElementById("formMatricular").elements.namedItem("password").value){
					noEsValido(getId);
				}
				else{
					passCorrecto=true;
					esValido(getId);
				}		
		}
