function navbarPromotionDetail() {
    let navbarPromotionDetailContent = `
        <a href="#">
            <button type="button" class="btn btn-primary">Retour</button>
        </a>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Informations générales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Retards</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Absences</a>
        </li>
    `;

    const navbarPromotionDetail = document.getElementById('navbarPromotionDetail');
    
    navbarPromotionDetail.innerHTML = navbarPromotionDetailContent;
}

navbar();
