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

        public function create($data) {
           
            $data = json_decode($data, true);

            print_r($data);

            $createUser = $this->usersRepository->create($data);

            http_response_code(200);

            header('Content-Type: application/json');

            $jsonData = json_encode($createUser);

            print_r($jsonData);
        }
}