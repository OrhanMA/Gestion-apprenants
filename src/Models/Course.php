<?php

class Course
{
  public $id;
  public $date;
  public $period;
  public $promotionId;

  public function getId()
  {
    return $this->id;
  }
  public function setId($value)
  {
    $this->id = $value;
  }

  public function getDate()
  {
    return $this->date;
  }
  public function setDate($value)
  {
    $this->date = $value;
  }

  public function getPeriod()
  {
    return $this->period;
  }
  public function setPeriod($value)
  {
    $this->period = $value;
  }

  public function getPromotionId()
  {
    return $this->promotionId;
  }
  public function setPromotionId($value)
  {
    $this->promotionId = $value;
  }
}
