export function navbarPromotionDetail() {
  let navbarPromotionDetailContent = `
  <nav class='navbar promotionNavbar'>
            <button type="button" class="btn btn-primary">Liste des cours</button>
            <button type="button" class="btn">Promotions</button>
            <button type="button" class="btn">Apprenants</button>
            <button type="button" class="btn">Absences</button>
    </nav>
    `;

  const navbarPromotionDetail = document.getElementById(
    "navbarPromotionDetail"
  );

  navbarPromotionDetail.innerHTML = navbarPromotionDetailContent;
}
