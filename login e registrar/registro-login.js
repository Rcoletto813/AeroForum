// verifica se há um parâmetro 'erro' na URL
/*const params = new URLSearchParams(window.location.search);
const erro = params.get('erro');

const titulo = params.get('titulo'); //obtem o titulo da mensagem
const mensagem = params.get('mensagem'); //obtem a mensagem
const tipo = params.get('tipo'); //obtem o tipo da mensagen --- btn-danger = erro; btn-success = deu tudo certo
const msgBtn = params.get('btn-msg'); //mensagem do botao de confirma

if (erro) { //houve algum erro que o php indicou
    console.log("hello world");
    modalAviso(titulo, mensagem, tipo, msgBtn);
}
*/
function modalAviso(titulo, mensagem, tipo, msgBtn, link) { //titulo de modal ; mensagem do modal ; cor do botão ; mensagem do botão ; link para redirecionamento
    // criar o modal
    const modal = document.createElement("div");
    modal.setAttribute("id", "modal");
    modal.classList.add("modal");
    modal.setAttribute("tabindex", "-1");
    modal.style.display = "block";

    // criar a caixa do diálogo
    const modalDialog = document.createElement("div");
    modalDialog.classList.add("modal-dialog");
    modal.appendChild(modalDialog);

    // criar o conteúdo do modal
    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    modalDialog.appendChild(modalContent);

    // criar o cabeçalho do modal
    const modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");
    modalContent.appendChild(modalHeader);

    // criar o título do modal
    const modalTitle = document.createElement("h5");
    modalTitle.classList.add("modal-title");
    modalTitle.textContent = titulo;
    modalHeader.appendChild(modalTitle);

    // criar o corpo do modal
    const modalBody = document.createElement("div");
    modalBody.classList.add("modal-body");
    modalContent.appendChild(modalBody);

    // adicionar o conteúdo do corpo do modal
    const modalBodyText = document.createElement("p");
    modalBodyText.textContent = mensagem;
    modalBody.appendChild(modalBodyText);

    // criar o rodapé do modal
    const modalFooter = document.createElement("div");
    modalFooter.classList.add("modal-footer");
    modalContent.appendChild(modalFooter);

    // criar o botão do rodapé do modal
    const closeButton2 = document.createElement("button");
    closeButton2.setAttribute("type", "button");
    closeButton2.classList.add("btn");
    closeButton2.classList.add(tipo);
    closeButton2.setAttribute("data-bs-dismiss", "modal");
    closeButton2.textContent = msgBtn;
    modalFooter.appendChild(closeButton2);
    closeButton2.addEventListener("click", function () {
        window.location.href = link;
        modal.remove();
    });

    // adicionar o modal ao body
    document.body.appendChild(modal);
}


//REGISTRO DE USUÁRIO//
/*function registrarGoogle() {
    const provider = new firebase.auth.GoogleAuthProvider();
    firebase.auth().signInWithPopup(provider)
        .then((userCredenciais) => {

            var sign = window.prompt('Você está se sentindo com sorte', 'certamente');

            const user = userCredenciais.user;
            const userId = user.uid; //id do usuário criado no firebase
            const userEmail = user.email; //email do usuário criado no firebase

            //mandar tudo para o PHP e salvar no MySql
            const xhr = new XMLHttpRequest();
            const url = "../php/registrar.php"
            const parametros = `username=${username}&email=${email}&uid=${userId}`;
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Redireciona o usuário para a página de perfil
                    window.location.href = "login.html";
                }
            };
            xhr.send(parametros);
            

            alert("Conta criada com sucesso")
        })
        .catch((error) => {
            // Ocorreu um erro ao tentar fazer login
        });
}*/

function criarContaEmailSenha() {
    const username = document.getElementById("usernameRegistro").value;
    const email = document.getElementById("emailRegistro").value;
    const senha = document.getElementById("senhaRegistro").value;
    const confirmaSenha = document.getElementById("senhaRegistroConfirmar").value;

    if (!username || !email || !senha || !confirmaSenha) {
        modalAviso("Dado inválido", "Preencha todos os campos.", "btn-danger", "Entendido!", "#");
        return;
    }

    if (senha != confirmaSenha) { // o usuário colocou senhas não correspondentes 
        modalAviso("Dado inválido", "As senhas não correspondem.", "btn-danger", "Entendido!", "#");
        senha.value = "";
        confirmaSenha.value = "";
        return;
    }

    firebase.auth().createUserWithEmailAndPassword(email, senha)
        .then(function (userCredenciais) {
            const user = userCredenciais.user;
            const userId = user.uid; //id do usuário criado no firebase

            //mandar tudo para o PHP e salvar no MySql
            const xhr = new XMLHttpRequest();
            const url = "../php/registrar.php"
            const parametros = `username=${username}&email=${email}&uid=${userId}`;
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Redireciona o usuário para a página de perfil
                    modalAviso("Sucesso", "Sua conta foi criada com sucesso. Agora é só fazer login.", "btn-success", "Eba!", "login.html");
                }
            };
            xhr.send(parametros);
        })
        .catch(function (error) {
            modalAviso("Erro", error.message, "btn-danger", "Entendido", "#");
        })
}
/////////////////////////////////////////////////////////

//LOGIN DE USUARIO//
function fazerLoginEmailSenha() {
    const email = document.getElementById("emailLogin").value;
    const senha = document.getElementById("senhaLogin").value;

    firebase.auth().signInWithEmailAndPassword(email, senha)
        .then((userCredenciais) => {
            const user = userCredenciais.user;

            window.location.href = "../main/main.php?uid=" + user.uid; //id do usuário como parametro
        })
        .catch((error) => {
            // Erro ao fazer login, exibe mensagem de erro
            modalAviso("Erro", error.message, "btn-danger", "Entendido", "#");
        });
}
