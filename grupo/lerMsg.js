function carregarMensagens(idGrupo, idSubcanal, username) {
    /*  <div class="msg">
        <span><a href="#">Autor-</a> mensagem1</span>
    </div>
    */
    mensagens = [];
    firebase.database().ref(`grupos/${idGrupo}/${idGrupo}/${idSubcanal}`).once('value', function (snapshot) {
        snapshot.forEach(function (item) {
            mensagens.push(item.val());
        });
        mensagens.pop();
        firebase.database().ref(`grupos/${idGrupo}/${idGrupo}/${idSubcanal}`).limitToLast(1).on('value', function (snapshot) {
            snapshot.forEach(function (item) {
                const caixaMsg = document.createElement("div");
                caixaMsg.classList.add("msg");

                const conteudoMsg = document.createElement("span");
                const linkUsuario = document.createElement("a");
                linkUsuario.href = "#";
                linkUsuario.textContent = item.val().Username;
                conteudoMsg.appendChild(linkUsuario);
                conteudoMsg.appendChild(document.createTextNode(" - " + item.val().Conteudo));

                caixaMsg.appendChild(conteudoMsg);

                const corpoHTML = document.getElementsByTagName("body")[0];
                corpoHTML.appendChild(caixaMsg);
            })
        });
        mensagens.forEach(element => {
            //console.log(element["Conteudo"])
            const caixaMsg = document.createElement("div");
            caixaMsg.classList.add("msg");

            const conteudoMsg = document.createElement("span");
            const linkUsuario = document.createElement("a");
            linkUsuario.href = "#";
            linkUsuario.textContent = element["Username"];
            conteudoMsg.appendChild(linkUsuario);
            conteudoMsg.appendChild(document.createTextNode(" - " + element["Conteudo"]));

            caixaMsg.appendChild(conteudoMsg);

            const corpoHTML = document.getElementsByTagName("body")[0];
            corpoHTML.appendChild(caixaMsg);
        });
    });
}

const params = new URLSearchParams(window.location.search);

const idGrupo = params.get("IdGrupo");
const idSubcanal = params.get("IdSubcanal");
const username = params.get("username");
const idUsername = params.get("idUsername");

carregarMensagens(idGrupo, idSubcanal, username);