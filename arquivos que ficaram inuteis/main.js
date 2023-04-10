//CONSTRUÇÃO DOS POSTS MAIS RECENTES//
/*                 <section class="post">
                    <h2 id="tituloPost">Título bem legal aqui</h2>
                    <p id="descricaoPost">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam
                        numquam
                        necessitatibus vitae tempore provident odio! Pariatur</p>
                    <div class="info">
                        <div class="container">
                            <button type="button" class="btn btn-outline-info">Acessar</button>
                            <div class="avaliacao">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <div class="autor"><a href="#">Autor: nomeUsuarioAqui</a></div>
                    </div>
                </section>
*/
for (let a = 0; a < 2; a++) {
    const section = document.createElement("section"); //elemento pai que engloba todos
    section.classList.add("post", "section");

    const tituloPost = document.createElement("h2"); //titulo do post
    tituloPost.id = "tituloPost";
    tituloPost.textContent = "Título de outro post muito bom"
    const descricaoPost = document.createElement("p"); //resumo do post --- primeiro paragrafo
    descricaoPost.id = "descricaoPost";
    descricaoPost.textContent = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam numquam necessitatibus vitae tempore provident odio! Pariaturl"

    const info = document.createElement("div"); //informacoes do post - nota e botao, botao de acessar e autor
    const container = document.createElement("div");
    info.classList.add("info");
    container.classList.add("container");

    const botoaAcessar = document.createElement("button") //botao de acessar o post
    botoaAcessar.classList.add("btn", "btn-outline-info");
    botoaAcessar.type = "button";
    botoaAcessar.textContent = "Acessar";

    const avaliacao = document.createElement("div"); //container das estrelas de avaliacao
    avaliacao.classList.add("avaliacao");
    for (let a = 0; a < 5; a++) {
        let estrela = document.createElement("span") //se a estrela estiver preenchida é adicionada a classe checked
        estrela.classList.add("fa", "fa-star")
        avaliacao.appendChild(estrela);
    }

    const autor = document.createElement("div"); //autor do post
    autor.classList.add("autor");
    const autorLink = document.createElement("a");
    autorLink.textContent = "Autor: nomeDoAutor";
    autorLink.href = "#";

    autor.appendChild(autorLink)

    section.appendChild(tituloPost);
    section.appendChild(descricaoPost);
    section.appendChild(info);

    info.appendChild(container);
    info.appendChild(autor);
    container.appendChild(botoaAcessar);
    container.appendChild(avaliacao);

    const post = document.getElementById("posts");
    post.appendChild(section);
}

//CONSTRUÇÃO DOS GRUPOS//
/*<section class="grupo section">
                    <div class="detalhesGrupo">
                        <img src="../imagens/logoGrupoDefault.png" alt="imagem grupo">
                        <div class="infoGrupo">
                            <h2 id="tituloGrupo">Nome grupo</h2>
                            <p id="marcadoresGrupo">#aviões #militar #caças-a-jato</p>
                            <span class="participantes">
                                Membros: 100
                            </span>
                        </div>
                        <button type="button" class="btn btn-success entrar">Participar desse grupo</button>
                    </div>
                </section>
*/
const section = document.createElement("section");
section.classList.add("grupo", "section");

const detalhesGrupo = document.createElement("div");
detalhesGrupo.classList.add("detalhesGrupo");
const imgGrupo = document.createElement("img");
imgGrupo.alt = "imagem do grupo";
imgGrupo.src = "../imagens/logoGrupoDefault.png"

const infoGrupo = document.createElement("infoGrupo");

const nomeGrupo = document.createElement("h2");
nomeGrupo.id = "tituloGrupo";
nomeGrupo.textContent = "Nome do grupo aqui";

const tagsGrupo = document.createElement("p");
tagsGrupo.id = "marcadoresGrupo";
tagsGrupo.textContent = "#tag1 #tag2";

const membrosGrupo = document.createElement("span");
membrosGrupo.classList.add("participantes");
membrosGrupo.textContent = "Membros: 500";

const entrarGrupo = document.createElement("button");
entrarGrupo.classList.add("btn", "btn-success", "entrar");
entrarGrupo.textContent = "Participar desse grupo";

section.appendChild(detalhesGrupo);
detalhesGrupo.appendChild(imgGrupo);
detalhesGrupo.appendChild(infoGrupo);
infoGrupo.appendChild(nomeGrupo);
infoGrupo.appendChild(tagsGrupo);
infoGrupo.appendChild(membrosGrupo);

detalhesGrupo.appendChild(entrarGrupo);

const containerGrupos = document.getElementById("grupos");
containerGrupos.appendChild(section);