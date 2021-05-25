/*function cargarMonitores(pagina){
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            monitores = JSON.parse(xhttp.responseText);
            mostrarProdcutos(monitores);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=listaMonitores");
}

function mostrarProdcutos(monitores){
    var listado = "";
    for(var i=0;i<monitores.length;i++){          
        listado +=   '<div class="col-lg-4 col-md-6 mb-4">';
        listado +=        '<div class="card h-100">';
        listado +=          '<a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>';
        listado +=          '<div class="card-body">';
        listado +=            '<h4 class="card-title">';
        listado +=              '<a href="#">'+monitores[i]['nombre']+' '+monitores[i]['apellido']+'</a>';
        listado +=            '</h4>';
        listado +=          '</div>';
        listado +=          '<div class="card-footer text-center">';
        listado +=              '<form action="monitor.php" method="get">'
        listado +=                 '<button type="submit" name="unMonitor" value="'+monitores[i]['dni']+'">Mas info</button>'
        listado +=              '</form>'
        listado +=            '<button onclick="addCarro(this.value)" class="btn btn-success" value="'+monitores[i]['dni']+'">Mas info</button>';
        listado +=          '</div>';
        listado +=        '</div>';
        listado +=      '</div>';
    }
    document.getElementById('monitores').innerHTML = listado;
}*/
function formMatricular(){
    document.getElementById('formMatricular').style = "display: block;";
    document.getElementById('formClase').style = "display: none;";
}

function formClase(){
    document.getElementById('formMatricular').style = "display: none;";
    document.getElementById('formClase').style = "display: block;";
}