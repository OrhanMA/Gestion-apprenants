function headerConnected() {
    let headerConnectedContent = `
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SIMPLON</a>
                <a>
                    <span class="navbar-text">Déconnexion</span>
                </a>
            </div>
        </nav>
    `;

    const headerConnected = document.getElementById('headerConnected');

    headerConnected.innerHTML = headerConnectedContent;
}

headerConnected();

