<?php

class UsersController
{

  use Validations;

  private $usersRepository;
  private $PromotionsRepository;

  public function __construct()
  {
    $this->usersRepository = new UsersRepository();
    $this->PromotionsRepository = new PromotionsRepository();
  }

  public function index()
  {

    $users = $this->usersRepository->getAll();

    http_response_code(200);

    header('Content-Type: application/json');

    $jsonData = json_encode($users);

    echo $jsonData;
  }

  public function create($data)
  {

    $data = json_decode($data, true);

    $dataIsSet = $this->allDataSetNotEmpty($data);
    $sanitizedData = $this->arraySanitize($data);
    $dataValid = $this->validateFormFields($sanitizedData);

    if (!$dataIsSet['valid']) {
      http_response_code(400);
      echo json_encode(array('message' => $dataIsSet['message']));
      return;
    }

    if (!$dataValid['valid']) {
      http_response_code(400);
      echo json_encode(array('message' => $dataValid['message']));
    }

    $createUser = $this->usersRepository->create($sanitizedData);

    if ($createUser) {
      http_response_code(201);
      echo json_encode(array("created" => $createUser, "message" => "Apprenant créé avec succès!"));
      header('Content-Type: application/json');
    } else {
      http_response_code(500);
      echo json_encode(array("message" => "Une erreur est survenue lors de la création de l'apprenant !"));
    }
  }

  public function update($data, $id)
  {
    $data = json_decode($data, true);

    $dataIsSet = $this->allDataSetNotEmpty($data);
    $sanitizedData = $this->arraySanitize($data);
    $dataValid = $this->validateFormFields($sanitizedData);

    if (!$dataIsSet['valid']) {
      http_response_code(400);
      echo json_encode(array('message' => $dataIsSet['message']));
      return;
    }

    if (!$dataValid['valid']) {
      http_response_code(400);
      echo json_encode(array('message' => $dataValid['message']));
      return;
    }

    $updatedUser = $this->usersRepository->update($sanitizedData, $id);

    if ($updatedUser) {
      http_response_code(200);
      echo json_encode(array("updated" => $updatedUser, "message" => "Apprenant mis à jour avec succès!"));
      header('Content-Type: application/json');
    } else {
      http_response_code(500);
      echo json_encode(array("message" => "Une erreur est survenue lors de la mise à jour de l'apprenant !"));
    }
  }

  public function delete($id)
  {
    $user = $this->usersRepository->getById($id);

    if (!$user) {
      http_response_code(404);
      echo json_encode(array("message" => "L'apprenant n'existe pas !"));
      return;
    }

    $data = $this->usersRepository->delete($id);

    http_response_code(200);
    header('Content-Type: application/json');
    $jsonData = json_encode($data);
    echo $jsonData;
  }
}
