<?php

class RolesController
{
  use Validations;
  private $roleRepository;

  public function __construct()
  {
    $this->roleRepository = new RolesRepository();
  }

  public function index()
  {
    $roles = $this->roleRepository->getAll();
    http_response_code(200);
    header('Content-Type: application/json');
    $jsonData = json_encode($roles);
    echo $jsonData;
  }
}
