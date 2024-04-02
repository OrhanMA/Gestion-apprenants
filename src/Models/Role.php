<?php

class Role
{
  public $id;
  public $name;

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getName()
  {
    return $this->name;
  }
  public function setName($value)
  {
    $this->name = $value;
  }
}
