<?php

class HomeController {
  private $homeRepository;

  public function __construct() {
    $this->homeRepository = new HomeRepository();
  }

  public function index() {
    $students = $this->homeRepository->findAll();

    if ($students !== null && $students !== false) {
      http_response_code(200); // 200 = OK
      header('Content-Type: application/json');
      $jsonData = json_encode($students);

      // Vérifie si l'encodage à reussit
      if ($jsonData !== false) {
        echo $jsonData;
      } else {
        http_response_code(500); // 500 = Internal Server Error
        echo json_encode(array('message' => 'Internal Server Error'));
      }
    } else {
      http_response_code(404); // 404 = Not Found
      echo json_encode(array('message' => 'No students found'));
    }
  }

  public function show($id)
  {
    $student = $this->studentRepository->findById($id);
    if ($student !== null && $student !== false) {
      http_response_code(200); // 200 = OK
      header('Content-Type: application/json');
      $jsonData = json_encode($student);
      // Vérifie si l'encodage à reussit
      if ($jsonData !== false) {
        echo $jsonData;
      } else {
        http_response_code(500); // 500 = Internal Server Error
        echo json_encode(array('message' => 'Internal Server Error'));
      }
    } else {
      http_response_code(404); // 404 = Not Found
      echo json_encode(array('message' => 'No student found'));
    }
  }

  public function store($data)
  {
    // First, check is $data['department_id'] exist
    $data = json_decode($data, true);
    // Vérifie que tous les champs sont fournis
    $data_is_set = $this->all_data_set_not_empty($data);

    if ($data_is_set['valid'] == false) {
      http_response_code(400); // 404 = Bad Request
      echo json_encode(array('message' => $data_is_set['message']));
      return;
    }

    $sanitized_data = $this->array_sanitize($data);

    $data_valid = $this->validate_students_fields($sanitized_data);
    if ($data_valid['valid'] == false) {
      http_response_code(400);
      echo json_encode(array('message' => $data_valid['message']));
    }

    // department_id int + max 11

    $department_id = $sanitized_data["department_id"];
    $department_exists = $this->departmentRepository->findById(array_search($department_id, $sanitized_data));

    if ($department_exists !== false) {
      $result = $this->studentRepository->create($sanitized_data);
      if ($result) {
        http_response_code(201); // 201 = Created
        echo json_encode(array("message" => "Student created successfully"));
      } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to create student"));
      }
    } else {
      http_response_code(400);
      echo json_encode(array('message' => "department_id $department_id does not exist hence can't be used to create a student ressource"));
      return;
    }
  }

  public function update($id, $data)
  {
    // Implémentation pour mettre à jour un élève existant
  }

  public function destroy($id)
  {
    // Implémentation pour supprimer un élève
  }
}