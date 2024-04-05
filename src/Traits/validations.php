
<?php

trait Validations
{
  public function arraySanitize($array)
  {
    $clean_array = array();
    foreach ($array as $key => $value) {
      $clean_array[$key] = htmlspecialchars($value);
    }
    return $clean_array;
  }

  public function allDataSetNotEmpty($data)
  {
    foreach ($data as $key => $value) {
      if (!isset($data[$key]) || empty($data[$key])) {
        return ['valid' => false, 'message' => "Le champ $key doit être fourni."];
      }
    }
    return ['valid' => true, 'message' => 'Toutes les données sont valides'];
  }

  public function respectStringLength(string $string, int $maxLength, int $minLength = 0): bool
  {
    $length = strlen($string);
    if ($length > $minLength && $length <= $maxLength) {
      return true;
    } else {
      return false;
    }
  }

  public function responseWithError(int $responseCode, string $message)
  {
    http_response_code($responseCode);
    header('Content-Type: application/json');
    $jsonData = json_encode(['created' => 'false', 'message' => $message]);
    echo $jsonData;
  }

  public function validateDate(string $dateString)
  {
    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    if (!preg_match($dateRegex, $dateString)) {
      return false;
    }
    if (!$this->respectStringLength($dateString, 10)) {
      return false;
    }
    return true;
  }

  public function validateNumber($number)
  {
    if (is_numeric($number)) {
      return true;
    } else {
      return false;
    }
  }

  public function validateFormFields($data)
  {
    $firstnameValid = $this->respectStringLength($data['firstname'], 50);
    if ($firstnameValid == false) {
      return ['valid' => false, 'message' => "Le prénom doit faire au maximum 50 caractères"];
    }

    $lastnameValid = $this->respectStringLength($data['lastname'], 50);
    if ($lastnameValid == false) {
      return ['valid' => false, 'message' => "Le nom de famille doit faire au maximum 50 caractères"];
    }

    $emailLengthValid = $this->respectStringLength($data['email'], 50);
    if ($emailLengthValid == false) {
      return ['valid' => false, 'message' => "L'email doit faire au maximum 50 caractères"];
    }

    $email = $data['email'];
    $emailFormatValid = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
    if ($emailFormatValid === 0) {
      return ['valid' => false, 'message' => "Le champ email doit respecter le format email (@ et .)"];
    }

    $role = $data['role'];
    $validRoles = ['manager', 'responsable', 'formateur', 'apprenant', 'delegue'];

    if (!isset($role) || empty($role)) {
      return ['valid' => false, 'message' => "Un rôle doit être choisi"];
    }

    if (!in_array($role, $validRoles)) {
      return ['valid' => false, 'message' => "Le rôle selectionné est invalide"];
    }

    $promotion = $data['promotion'];
    $validPromotions = ['promotion1', 'promotion2', 'promotion3'];

    if (!isset($promotion) || empty($promotion)) {
      return ['valid' => false, 'message' => "Une promotion doit être selectionnée"];
    }

    if (!in_array($promotion, $validPromotions)) {
      return ['valid' => false, 'message' => "Le promotion selectionnée est invalide"];
    }
    return ['valid' => true, 'message' => 'Tous les champs du formulaire sont valides'];
  }
}
