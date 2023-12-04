const form = document.querySelector(".textarea"),
// incoming_id = form.querySelector(".incoming_id").value,
inputField = document.getElementById("mensaje"),
idUsuarioLogueado = document.getElementById("identificacion").value,
sendBtn = form.querySelector(".enviar"),
chatBox = document.querySelector(".panel-chat");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}


// setInterval(() =>{

//     var idPropietario = document.getElementById("idPropietario").value;
//     console.log(idPropietario);
//     if (idPropietario === null) {
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST", "../../App/Modules/Mensajes/mensajes_negocios.php", true);
//         xhr.onload = () => {
//             if (xhr.readyState === XMLHttpRequest.DONE) {
//                 if (xhr.status === 200) {
//                     let data = xhr.response;
//                     chatBox.innerHTML = data;
//                     if (!chatBox.classList.contains("active")) {
//                         scrollToBottom();
//                     }
//                 }
//             }
//         };
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.send("incoming_id=" + idPropietario.value + "&idUsuarioLogueado=" + idUsuarioLogueado);
//     } else {
//         chatBox.innerHTML = '<div class="text">No hay mensajes disponibles1. Una vez que envíe el mensaje, aparecerán aquí.</div>';
//     }


// }, 40000);


// function obtenerChats(){

//     var idPropietario = document.getElementById("idPropietario").value;
//     if (idPropietario === null) {
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST", "../../App/Modules/Mensajes/mensajes_negocios.php", true);
//         xhr.onload = () => {
//             if (xhr.readyState === XMLHttpRequest.DONE) {
//                 if (xhr.status === 200) {
//                     let data = xhr.response;
//                     chatBox.innerHTML = data;
//                     if (!chatBox.classList.contains("active")) {
//                         scrollToBottom();
//                     }
//                 }
//             }
//         };
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.send("incoming_id=" + idPropietario.value + "&idUsuarioLogueado=" + idUsuarioLogueado);
//     } else {
//         chatBox.innerHTML = '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
//     }
// }
    

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
  

// var idPropietario_INPUT = document.getElementById("idPropietario");
// idPropietario_INPUT.addEventListener("change", function() {
//     // Función que se ejecutará cuando cambie el valor del input hidden
//     console.log("Valor cambiado:", idPropietario_INPUT.value);

//     obtenerChats();
//     // Iniciar un intervalo, por ejemplo:
//     // var intervalId = setInterval(function() {
//     //     obtenerChats();
//     // }, 60000);
// });


  
// setInterval(() =>{
// }, 500);