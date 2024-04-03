<?php

class PromotionsController
{
  use Validations;
  private $promotionRepository;

  public function __construct()
  {
    $this->promotionRepository = new PromotionsRepository();
  }

  // update, delete, show?
  public function index()
  {
    $promotions = $this->promotionRepository->getAll();
    http_response_code(200);
    header('Content-Type: application/json');
    $jsonData = json_encode($promotions);
    echo $jsonData;
  }

  public function create($data)
  {
    $data = json_decode($data, true);
    $dataValid = $this->allDataSetNotEmpty($data);
    if (!$dataValid['valid']) {
      http_response_code(400);
      header('Content-Type: application/json');
      $jsonData = json_encode(['created' => 'false', 'message' => $dataValid['message'], 'promotion' => $data]);
      echo $jsonData;
      exit();
    }
    $sanitizedData = $this->arraySanitize($data);
    $nameLengthValid = $this->respectStringLength($sanitizedData['name'], 80);
    $startDateValid = $this->validateDate($sanitizedData['startDate']);
    $endDateValid = $this->validateDate($sanitizedData['endDate']);
    $placesValid = $this->validateNumber($sanitizedData['places']);

    if (!$nameLengthValid) {
      $this->responseWithError(400, "Le nom de promotion ne doit pas dépasser 80 lettres");
      exit();
    }
    if (!$startDateValid) {
      $this->responseWithError(400, "Le format de la date de début de promotion n'est pas valide");
      exit();
    }
    if (!$endDateValid) {
      $this->responseWithError(400, "Le format de la date de fin de promotion n'est pas valide");
      exit();
    }
    if (!$placesValid) {
      $this->responseWithError(400, "Le champ places doit être un nombre");
      exit();
    }

    $createResponse = $this->promotionRepository->create($sanitizedData);
    http_response_code(201);
    header('Content-Type: application/json');
    $jsonData = json_encode(['created' => $createResponse, 'message' => 'La ressource a bien été créée', 'promotion' => $sanitizedData]);
    echo $jsonData;
    exit();
  }
  public function update($data, $id)
  {
    $data = json_decode($data, true);
    $dataValid = $this->allDataSetNotEmpty($data);
    if (!$dataValid['valid']) {
      http_response_code(400);
      header('Content-Type: application/json');
      $jsonData = json_encode(['created' => 'false', 'message' => $dataValid['message'], 'promotion' => $data]);
      echo $jsonData;
      exit();
    }

    $sanitizedData = $this->arraySanitize($data);
    $nameLengthValid = $this->respectStringLength($sanitizedData['name'], 80);
    $startDateValid = $this->validateDate($sanitizedData['startDate']);
    $endDateValid = $this->validateDate($sanitizedData['endDate']);
    $placesValid = $this->validateNumber($sanitizedData['places']);

    if (!$nameLengthValid) {
      $this->responseWithError(400, "Le nom de promotion ne doit pas dépasser 80 lettres");
      exit();
    }
    if (!$startDateValid) {
      $this->responseWithError(400, "Le format de la date de début de promotion n'est pas valide");
      exit();
    }
    if (!$endDateValid) {
      $this->responseWithError(400, "Le format de la date de fin de promotion n'est pas valide");
      exit();
    }
    if (!$placesValid) {
      $this->responseWithError(400, "Le champ places doit être un nombre");
      exit();
    }

    $existingPromotion = $this->promotionRepository->getById($id);
    if (!$existingPromotion) {
      $this->responseWithError(400, "Aucune ressource n'existe avec cet id.");
      exit();
    }

    $createResponse = $this->promotionRepository->update($sanitizedData, $id);
    http_response_code(201);
    header('Content-Type: application/json');
    $jsonData = json_encode(['created' => $createResponse, 'message' => 'La ressource a bien été mise à jour', 'promotion' => $sanitizedData]);
    echo $jsonData;
    exit();
  }

  public function delete()
  {
  }
}
