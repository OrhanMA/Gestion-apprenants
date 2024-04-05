import { getPromotion } from "./promotionUpdate.js";

export async function promotionDetailInfos(target, promotionId) {
  const response = await getPromotion(promotionId);
  const promotion = response.promotion;
  let promotionDetailInfosContent = `
    <div>
    <h1 class="titlePromotionDetails">Détails de la promotion ${promotion.name}</h1>
    <p class="descriptionParagraph">Informations générales de la promotion</p>
    <p class="descriptionParagraph">début: ${promotion.startDate}</p>
    <p class="descriptionParagraph">fin: ${promotion.endDate}</p>
    <p class="descriptionParagraph">places: ${promotion.places}</p>
    </div>`;

  const promotionDetailInfos = document.getElementById("promotionDetailInfos");

  promotionDetailInfos.innerHTML = promotionDetailInfosContent;

  target.appendChild(promotionDetailInfosContent);
}
