// verifica se há um parâmetro 'erro' na URL
const params = new URLSearchParams(window.location.search);
const erro = params.get('erro');

const titulo = params.get('titulo'); //obtem o titulo da mensagem
const mensagem = params.get('mensagem'); //obtem a mensagem
const tipo = params.get('tipo'); //obtem o tipo da mensagen --- btn-danger = erro; btn-success = deu tudo certo
const msgBtn = params.get('btn-msg'); //mensagem do botao de confirma

if (erro) { //houve algum erro que o php indicou
    console.log("hello world");
    modalAviso(titulo, mensagem, tipo, msgBtn);
}

function modalAviso(titulo, mensagem, tipo, msgBtn) {
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
        modal.remove();
    });

    // adicionar o modal ao body
    document.body.appendChild(modal);
}

// CRIAR CONTA //
/*function registrarGithub() {
    const provider = new firebase.auth.GithubAuthProvider();
    firebase.auth().signInWithPopup(provider)
        .then((result) => {
            // O usuário se autenticou com sucesso
        })
        .catch((error) => {
            // Ocorreu um erro ao tentar fazer login
        });
}

function registrarFacebook() {
    const provider = new firebase.auth.FacebookAuthProvider();
    firebase.auth().signInWithPopup(provider)
        .then((result) => {
            // O usuário se autenticou com sucesso
        })
        .catch((error) => {
            // Ocorreu um erro ao tentar fazer login
        });
}

function registrarTwitter() {
    const provider = new firebase.auth.TwitterAuthProvider();
    firebase.auth().signInWithPopup(provider)
        .then((result) => {
            // O usuário se autenticou com sucesso
        })
        .catch((error) => {
            // Ocorreu um erro ao tentar fazer login
        });
}*/
function registrarGoogle() {
    const provider = new firebase.auth.GoogleAuthProvider();
    firebase.auth().signInWithPopup(provider)
        .then((result) => {
            alert("Conta criada com sucesso")
        })
        .catch((error) => {
            // Ocorreu um erro ao tentar fazer login
        });
}

/*function criarContaEmailSenha() {
    const email = document.getElementById("emailRegistro");
    const senha = document.getElementById("senhaRegistro");
    const confirmaSenha = document.getElementById("senhaRegistroConfirmar");

    if (senha.value != confirmaSenha.value) { // o usuário colocou senhas não correspondentes 
        modalAviso("Dado inválido", "As senhas não correspondem", "btn-danger");
        senha.value = "";
        confirmaSenha.value = "";
        return;
    }

    firebase.auth().createUserWithEmailAndPassword(email.value, senha.value)
        .then(function () {
            modalAviso("Sucesso", "Sua conta foi criada com sucesso. Agora é só fazer login", "btn-success");
        })
        .catch(function (error) {
            modalAviso("Erro", error.message, "btn-danger");
        })
}

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById("createAccount").addEventListener("submit", function (event) {
        event.preventDefault();
        criarContaEmailSenha();
    });
});*/
/////////////////////////////////////////////////////////