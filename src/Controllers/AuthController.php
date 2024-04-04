<?php

class AuthController
{
  use Validations;
  private $usersRepository;

  public function __construct()
  {
    $this->usersRepository = new UsersRepository();
  }

  public function login($data)
  {
    $data = json_decode($data, true);
    $sanitizedData = $this->arraySanitize($data);

    $user = $this->usersRepository->getByEmail($sanitizedData['email']);

    if (!$user) {
      http_response_code(400);
      echo json_encode(['success' => false, "message" => "Il n'y a pas d'apprenants avec cette adresse email."]);
      exit();
    }

    if ($user['password'] !== $sanitizedData['password']) {
      http_response_code(401);
      echo json_encode(['success' => false, "message" => 'Identifiants invalides. Veuillez réesayer.']);
      exit;
    }

    http_response_code(200);
    echo json_encode(['success' => true, "message" => "La tentative de connexie est réussie", 'user' => $user]);
  }

  public function checkExisitingEmail($data)
  {
    $data = json_decode($data, true);
    $email = htmlspecialchars($data["email"]);

    $user = $this->usersRepository->getByEmail($email);

    if (!isset($user) || $user == false) {
      // Pas de user avec cet email
      http_response_code(404); // Unauthorized
      echo json_encode(['valid' => false, 'message' => "Aucun utilisateur n'est enregistré avec cet email"]);
      exit();
    }

    http_response_code(200);
    echo json_encode(['valid' => true, 'message' => "Un compte avec cette adresse email a bien été trouvé", 'user' => $user]);
    exit();
  }

  public function createPassword($data)
  {
    $data = json_decode($data, true);
    $dataValid = $this->allDataSetNotEmpty($data);

    if (!$dataValid['valid']) {
      $this->responseWithError(400, $dataValid['message']);
      exit();
    }

    $sanitizedData = $this->arraySanitize($data);

    if ($sanitizedData['password'] !== $sanitizedData['passwordConfirm']) {
      $this->responseWithError(400, "Les mots de passe doivent être identiques.");
      exit();
    }

    $passwordValid = $this->respectStringLength($sanitizedData['password'], 255);

    if (!$passwordValid) {
      $this->responseWithError(400, "Le mot de passe ne doit pas dépasser 255 caractères.");
      exit();
    }

    $userExists = $this->usersRepository->getById($sanitizedData['userId']);

    if ($userExists == null || $userExists == false) {
      $this->responseWithError(400, "Il n'y a pas de user avec cet identifiant");
      exit();
    }


    $createPasswordResponse = $this->usersRepository->updatePassword($sanitizedData['password'], $sanitizedData['userId']);

    if (!$createPasswordResponse) {
      $this->responseWithError(400, "La mise à jour du mot de passe a échoué.");
      exit();
    }
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['created' => true, 'message' => 'Le mot de passe a bien été mise à jour']);
    exit();
  }
}
