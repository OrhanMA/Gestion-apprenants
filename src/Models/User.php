<?php

class User
{
  public $id;
  public $firstNname;
  public $lastName;
  public $active;
  public $email;
  public $password;
  public $roleId;

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getFirstNname()
  {
    return $this->firstNname;
  }
  public function setFirstNname($value)
  {
    $this->firstNname = $value;
  }

  public function getLastName()
  {
    return $this->lastName;
  }
  public function setLastName($value)
  {
    $this->lastName = $value;
  }

  public function getActive()
  {
    return $this->active;
  }
  public function setActive($value)
  {
    $this->active = $value;
  }

  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($value)
  {
    $this->email = $value;
  }

  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($value)
  {
    $this->password = $value;
  }

  public function getRoleId()
  {
    return $this->roleId;
  }
  public function setRoleId($value)
  {
    $this->roleId = $value;
  }
}
