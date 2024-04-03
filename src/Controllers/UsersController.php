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

        public function update($data, $id) {

            $data = $this->usersRepository->update($data, $id);
  
            http_response_code(200);
  
            header('Content-Type: application/json');
  
            $jsonData = json_encode($data);
  
            echo$jsonData;
          }

        public function delete($id) {

            $data = $this->usersRepository->delete($id);
  
            http_response_code(200);
  
            header('Content-Type: application/json');
  
            $jsonData = json_encode($data);
  
            echo$jsonData;
          }
}