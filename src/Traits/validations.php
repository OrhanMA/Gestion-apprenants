
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
        return ['valid' => false, 'message' => "$key must be provided"];
      }
    }
    return ['valid' => true, 'message' => 'all data is set and not empty in the array'];
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

    public function validateFormFields($data)
    {
        $firstnameValid = $this->respectStringLength($data['firstname'], 50);
        if ($firstnameValid == false) {
            return ['valid' => false, 'message' => "firstname max length must be 50 characters"];
        }

        $lastnameValid = $this->respectStringLength($data['lastname'], 50);
        if ($lastnameValid == false) {
            return ['valid' => false, 'message' => "lastname max length must be 50 characters"];
        }

        $emailLengthValid = $this->respectStringLength($data['email'], 50);
        if ($emailLengthValid == false) {
            return ['valid' => false, 'message' => "email max length must be 50 characters"];
        }

        $email = $data['email'];
        $emailFormatValid = preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
        if ($emailFormatValid === 0) {
            return ['valid' => false, 'message' => "email must be of email format"];
        }

        $role = $data['role'];
        $validRoles = ['manager', 'responsable', 'formateur', 'apprenant', 'delegue'];

        if (!isset($role) || empty($role)) {
            return ['valid' => false, 'message' => "role must be selected"];
        }

        if (!in_array($role, $validRoles)) {
            return ['valid' => false, 'message' => "invalid role selected"];
        }
        
        $promotion = $data['promotion'];
        $validPromotions = ['promotion1', 'promotion2', 'promotion3'];

        if (!isset($promotion) || empty($promotion)) {
            return ['valid' => false, 'message' => "promotion must be selected"];
        }

        if (!in_array($promotion, $validPromotions)) {
            return ['valid' => false, 'message' => "invalid promotion selected"];
        }

        return ['valid' => true, 'message' => 'all form fields are valid'];
    }
}