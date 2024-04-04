<?php

class AuthController
{
  private $usersRepository;

  public function __construct()
  {
    $this->usersRepository = new UsersRepository();
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
}
