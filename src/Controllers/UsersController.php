<?php

class UsersController {

        private $usersRepository;
      
        public function __construct() {
          $this->usersRepository = new UsersRepository();
        }
      
        public function index() {

          $users = $this->usersRepository->getAll();

          http_response_code(200);

          header('Content-Type: application/json');

          $jsonData = json_encode($users);

          echo$jsonData;
        }
}