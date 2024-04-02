<?php

class Course
{
  public $id;
  public $name;
  public $startDate;
  public $endDate;
  public $places;

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

  public function getStartDate()
  {
    return $this->startDate;
  }
  public function setStartDate($value)
  {
    $this->startDate = $value;
  }

  public function getEndDate()
  {
    return $this->endDate;
  }
  public function setEndDate($value)
  {
    $this->endDate = $value;
  }

  public function getPlaces()
  {
    return $this->places;
  }
  public function setPlaces($value)
  {
    $this->places = $value;
  }
}
