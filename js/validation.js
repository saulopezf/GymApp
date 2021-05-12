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
		if(dniCorrecto&&nombreCorrecto&&apeCorrecto&&tlfnoCorrecto&&mailCorrecto&&usuCorrecto&&passCorrecto){
			return true;
		}
		else{
			document.getElementById('errorVali').innerHTML="Por favor, rellene los campos incorrectos o vacios";
			return false;	
		}
}

function validarElementos(){
	validarDNI(document.getElementById('dniRegistro').value,"errorDNI");
	validarNombre(document.getElementById('nombreRegistro').value,"errorNombre");
	validarApellidos(document.getElementById('apeRegistro').value,"errorApe");
	validarMail(document.getElementById('mailRegistro').value,"errorMail");
	validarTlfno(document.getElementById('tlfnoRegistro').value,"errorTlfno");
	validarUser(document.getElementById('userRegistro').value,"errorUser");
	validarPass(document.getElementById('passRegistro').value,"errorPass")
}


		function validarDNI(dni,error){
				if(!dniRegex.test(dni)){
					document.getElementById(error).innerHTML="DNI introducido incorrecto";
				}
				else{
					dniCorrecto=true;
					document.getElementById(error).innerHTML="";
				}
				
		}

		function validarNombre(nombre,error){
				if(!noNumber.test(nombre)){
					document.getElementById(error).innerHTML="No puede contener numeros";
				}
				else{
					nombreCorrecto=true;
					document.getElementById(error).innerHTML="";
				}
		}

		function validarApellidos(apellido,error){
				if(!noNumber.test(apellido)){
					document.getElementById(error).innerHTML="No puede contener numeros";
				}
				else{
					apeCorrecto=true;
					document.getElementById(error).innerHTML="";
				}
		}

		function validarMail(mail,error){
				if(!mailRegex.test(mail)){
					document.getElementById(error).innerHTML="Email introducido incorrecto";	
				}
				else{
					mailCorrecto=true;
					document.getElementById(error).innerHTML="";
				}
		}

		function validarTlfno(tlfno,error){
				if(!tlfnoRegex.test(tlfno)){
					document.getElementById(error).innerHTML="Numero introducido incorrecto";
				}
				else{
					tlfnoCorrecto=true;
					document.getElementById(error).innerHTML="";
				}		
		}

		function validarUser(user,error){
				usuCorrecto=true;
				document.getElementById(error).innerHTML="";
		}

		function validarPass(pass,error){
				if(pass!=document.getElementById("formulario").elements.namedItem("password").value){
					document.getElementById(error).innerHTML="Las contraseñas tienen que coincidir";
				}
				else{
					passCorrecto=true;
				document.getElementById(error).innerHTML="";
				}		
		}
