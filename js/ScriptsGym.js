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
var user;
var userChat;
var nuevoChat = false;

function getUsuarioActual(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            user = xhttp.responseText;
            console.log(user);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=getUsuarioActual");
}

function cargarMensajeria(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            var listaDeChats = JSON.parse(xhttp.responseText);
            mostrarUltimosChats(listaDeChats);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=listaDeChats");
}

function mostrarUltimosChats(listaDeChats){
    var chat = "";
    if(nuevoChat){
        var c=0;
        for(var i=0;i<listaDeChats.length;i++){
            if(listaDeChats[i]['dni']==userChat){
                c++;
            }
        }
        if(c==0){
            chat += '<div class="chat_list" onclick="cargarChat(`'+userChat+'`)">';
            chat +=          '<div class="chat_people">';
            chat +=            '<div class="chat_ib">';
            chat +=              '<h5>'+userChat+' (Nuevo Chat)<span class="chat_date"></span></h5>';
            chat +=              '<p></p>';
            chat +=            '</div>';
            chat +=          '</div>';
            chat +=        '</div>';
            nuevoChat = false;
        }
        cargarChat(userChat);
    }
    for(var i=0;i<listaDeChats.length;i++){
        var d = new Date(listaDeChats[i]['fechaMsg']);
        chat += '<div class="chat_list" id="chat'+i+'" onclick="cargarChat(`'+listaDeChats[i]['dni']+'`,`chat'+i+'`)">';
        chat +=          '<div class="chat_people">';
        chat +=            '<div class="chat_ib">';
        chat +=              '<h5>'+listaDeChats[i]['nombre']+' '+listaDeChats[i]['apellido']+'<span class="chat_date">'+(d.getMonth()+1)+'/'+d.getDate()+'</span></h5>';
        chat +=              '<p id="ultimoMsg'+i+'">'+listaDeChats[i]['mensaje']+'</p>';
        chat +=            '</div>';
        chat +=          '</div>';
        chat +=        '</div>';
        //ultimoMensaje(listaDeChats[i]['fromMsg'],i); 
    }  
    document.getElementById('inbox_chat').innerHTML = chat;
}

function ultimoMensaje(dniChat,i){
    userChat = dniChat;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            var ultimoMensaje = JSON.parse(xhttp.responseText);
            document.getElementById('ultimoMsg'+i).innerHTML = ultimoMensaje[0]["mensaje"];
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=ultimoMensaje&dniChat="+userChat);
}

function cargarChat(dniChat,chatNum){
    userChat = dniChat;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            var listaDeMensajes = JSON.parse(xhttp.responseText);
            mostrarMensajes(listaDeMensajes);
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=mensajesChat&dniChat="+userChat);
}

function mostrarMensajes(listaDeMensajes){
    var chat = "";
    for(var i=0;i<listaDeMensajes.length;i++){
        var d = new Date(listaDeMensajes[i]['fechaMsg']);
        if(listaDeMensajes[i]['fromMsg'] == user){
            chat +='<div class="outgoing_msg">'
            chat +=  '<div class="sent_msg">'
            chat +=    '<p>'+listaDeMensajes[i]['mensaje']+'</p>'
            chat +=    '<span class="time_date">'+(d.getHours()+1)+':'+d.getMinutes()+' | '+d.getDate()+'/'+(d.getMonth()+1)+'</span> </div>'
            chat +=  '</div>'
            chat +='</div>'
            console.log("mio: "+listaDeMensajes[i]['mensaje']);
        }
        else{
            chat +='<div class="incoming_msg">'
            chat +=  '<div class="received_msg">'
            chat +=    '<div class="received_withd_msg">'
            chat +=      '<p>'+listaDeMensajes[i]['mensaje']+'</p>'
            chat +=      '<span class="time_date">'+(d.getHours()+1)+':'+d.getMinutes()+' | '+d.getDate()+'/'+(d.getMonth()+1)+'</span></div>'
            chat +=  '</div>'
            chat +='</div>'
            console.log("para mi: "+listaDeMensajes[i]['mensaje']);
        }
    }
    document.getElementById('type_msg').style = "display:block;"
    document.getElementById('chat').innerHTML = chat;
}

function comprobarMsg(){
    var mensaje = document.getElementById('mensajeEnviar').value;
    if(mensaje != ""){
        enviarMsg(mensaje);
    }
}

function enviarMsg(mensaje){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            cargarChat(userChat);
            document.getElementById('mensajeEnviar').value = "";
            cargarMensajeria();
        }
    };
    xhttp.open("POST", "php/consultas.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("consulta=enviarMsg&dniChat="+userChat+"&mensaje="+mensaje);
}