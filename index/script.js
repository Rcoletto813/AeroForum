const parallax = document.querySelector('.parallax');

window.addEventListener('scroll', () => {
    let offset = window.pageYOffset;
    parallax.style.backgroundPositionY = offset * 0.7 + 'px';
});

//aparecimento dos elementos
window.addEventListener('scroll', revelar);

function revelar() {
    var revelacao = document.querySelectorAll(".revelar");

    for (var i = 0; i < revelacao.length; i++) {
        var alturaPagina = window.innerHeight;
        var revelarTopo = revelacao[i].getBoundingClientRect().top;
        var pontoRevelar = 150;

        if (revelarTopo < alturaPagina - 20) {
            revelacao[i].classList.add("ativar")
        }
    }
}
