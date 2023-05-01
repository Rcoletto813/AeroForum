const queryString = window.location.search; //obter url
const urlParams = new URLSearchParams(queryString); //obter parametros da url
const product = urlParams.get('id') //localizar o id do post

function avalia(nota) {
    const queryString = window.location.search; //obter url
    const urlParams = new URLSearchParams(queryString); //obter parametros da url
    const idPost = urlParams.get('id') //localizar o id do post

    const avaliaPositivo = document.getElementById("avalia1");
    const avaliaNegativo = document.getElementById("avalia-1");
    const notaHTML = document.getElementById("notaUser");

    avaliaPositivo.style.fill = "unset";
    avaliaNegativo.style.fill = "unset";

    if (notaHTML.textContent == 1 && nota == 1 || notaHTML.textContent == -1 && nota == -1) {
        //delete na tabela de avaliacao
        notaHTML.textContent = 0;
        notaPHP(notaHTML.textContent, idPost, false);
        return;
    }

    notaHTML.textContent = nota;
    if (nota == 1) {
        //acrescentar 1 na tabela de avaliacao
        avaliaPositivo.classList.add("fa-shake");
        avaliaPositivo.style.fill = "#fa9214";
        setTimeout(() => {
            avaliaPositivo.classList.remove("fa-shake");
        }, 1000);
        notaPHP(notaHTML.textContent, idPost, true);
    }
    if (nota == -1) {
        //acrescentar -1 na tabela de avaliacao
        avaliaNegativo.classList.add("fa-shake");
        avaliaNegativo.style.fill = "#fa9214";
        setTimeout(() => {
            avaliaNegativo.classList.remove("fa-shake");
        }, 1000);
        notaPHP(notaHTML.textContent.trim(), idPost.trim(), true);
    }
}

function notaPHP(nota, id_post, add) {
    const xhr = new XMLHttpRequest();
    const url = "../php/avaliar.php"
    const parametros = `nota=${nota}&post=${id_post}&action=${add}`; //action --> indicar se é para inserir ou deletar na tabela de avaliacao
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(parametros);
}