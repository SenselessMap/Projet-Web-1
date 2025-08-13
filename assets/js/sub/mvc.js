function loadHTML(containerId, relativePath) {
    const currentPath = window.location.pathname;
    const projectFolder = "maquette2";
    const index = currentPath.indexOf(projectFolder);

    if (index === -1) {
        console.error("Dossier pas trouvé");
        return;
    }
    const baseUrl = window.location.origin + "/" + projectFolder + "/";

    const fullUrl = baseUrl + relativePath;

    fetch(fullUrl)
        .then(response => {
            if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);
            return response.text();
        })
        .then(data => {
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = data;
            } else {
                console.log("blabla0");
            }
        })
        .catch(err => console.error(`Erreur.. chemin: ${filePath}:`, err));
}

//le loading
loadHTML("nav-container", "assets/view/nav.html");
loadHTML("footer-container", "assets/view/footer.html");
