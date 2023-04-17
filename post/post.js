function avalia(nota) {
    const avaliaPositivo = document.getElementById("avalia1");
    const avaliaNegativo = document.getElementById("avalia-1");
    const notaHTML = document.getElementById("notaUser");

    avaliaPositivo.style.fill = "unset";
    avaliaNegativo.style.fill = "unset";

    if (notaHTML.textContent == 1 && nota == 1 || notaHTML.textContent == -1 && nota == -1) {
        notaHTML.textContent = 0;
        return;
    }

    notaHTML.textContent = nota;
    if (nota == 1) {
        avaliaPositivo.classList.add("fa-shake");
        avaliaPositivo.style.fill = "#fa9214";
        setTimeout( () => {
            avaliaPositivo.classList.remove("fa-shake");
        }, 1000);
    }
    if (nota == -1) {
        avaliaNegativo.classList.add("fa-shake");
        avaliaNegativo.style.fill = "#fa9214";
        setTimeout( () => {
            avaliaNegativo.classList.remove("fa-shake");
        }, 1000);
    }
}