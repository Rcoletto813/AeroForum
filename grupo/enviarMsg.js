function enviarMensagem(idGrupo, idSubcanal, username, idUsername, conteudo) {
    firebase.database().ref(`${idGrupo}/${idSubcanal}`).once('value', function (snapshot) {
        const ultimaMsgNumero = Object.keys(snapshot.val()).pop();
        const novaMsg = {
            IdUser: idUsername,
            Username: username,
            Data: firebase.database.ServerValue.TIMESTAMP,
            Conteudo: conteudo
        };
        firebase.database().ref(`${idGrupo}/${idSubcanal}`).child(parseInt(ultimaMsgNumero) + 1).set(novaMsg);
    });
}

document.getElementById("msg").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("enviar").click();
    }
  });

document.getElementById("enviar").addEventListener("click", function () {
    const idGrupo = document.getElementById("idGrupo");
    const idSubcanal = document.getElementById("idSubcanal");
    const username = document.getElementById("username");
    const idUsername = document.getElementById("idUsername");
    const conteudo = document.getElementById("msg");
    enviarMensagem(idGrupo.value, idSubcanal.value, username.value, idUsername.value, conteudo.value);
    conteudo.value = "";
});