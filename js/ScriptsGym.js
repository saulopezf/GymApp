function formMatricular(){
    document.getElementById('botones-registro').style = "display: none;";
    document.getElementById('divRegistro').style = "display: block;";
    document.getElementById('formMatricular').style = "display: block;";
    document.getElementById('formClase').style = "display: none;";
}

function formClase(){
    document.getElementById('botones-registro').style = "display: none;";
    document.getElementById('divRegistro').style = "display: block;";
    document.getElementById('formMatricular').style = "display: none;";
    document.getElementById('formClase').style = "display: block;";
}

function atras(){
    document.getElementById('botones-registro').style = "display: block;";
    document.getElementById('divRegistro').style = "display: none;";
    document.getElementById('formMatricular').style = "display: none;";
    document.getElementById('formClase').style = "display: none;";
    
}