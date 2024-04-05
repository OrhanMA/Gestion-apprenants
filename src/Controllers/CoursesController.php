<?php

class CoursesController
{

    use Validations;

    private $coursesRepository;
    private $usersRepository;

    public function __construct()
    {
        $this->coursesRepository = new CoursesRepository();
        $this->usersRepository = new UsersRepository();
    }

    public function index()
    {

        $courses = $this->coursesRepository->getAll();

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode(['courses' => $courses]);
    }

    public function signUserCourse($data)
    {
        $data = json_decode($data, true);
        $id = isset($data['userCourseId']) ? htmlspecialchars($data['userCourseId']) : null;

        if (!isset($id) || empty($id)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'userCourseId doit être fourni']);
            exit();
        }

        $existingUserCourse = $this->coursesRepository->getUserCourseById($id);

        if (!$existingUserCourse) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Aucun user_course ne correspond à l'id $id"]);
            exit();
        }

        $signResponse = $this->coursesRepository->signUserCourse($id);

        if (!$signResponse) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'La signature du cours a échouée', 'user_course' => []]);
            exit();
        }

        $userCourse = $this->coursesRepository->getUserCourseById($id);

        http_response_code(200);
        echo json_encode(['success' => true, 'user_course' => $userCourse]);
        exit();
    }

    public function getUserCourses($data)
    {
        $data = json_decode($data, true);
        $id = isset($data['userId']) ? htmlspecialchars($data['userId']) : null;

        if (!isset($id) || empty($id)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'userId doit être fourni', 'courses' => []]);
            exit();
        }

        $existingUser = $this->usersRepository->getById($id);

        if (!$existingUser) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "Aucun user ne correspond à l'id $id", 'courses' => []]);
            exit();
        }

        $courses = $this->coursesRepository->getUserCourses($id);

        if (!$courses) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Aucun cours à récupérer', 'courses' => []]);
            exit();
        }

        http_response_code(200);
        echo json_encode(['success' => true, 'courses' => $courses]);
        exit();
    }


    public function create($data)
    {
        $data = json_decode($data, true);
        $dataValid = $this->allDataSetNotEmpty($data);

        if (!$dataValid['valid']) {
            http_response_code(400);
            header('Content-Type: application/json');
            $jsonData = json_encode(['created' => 'false', 'message' => $dataValid['message'], 'courses' => $data]);
            echo $jsonData;
            exit();
        }

        $sanitizedData = $this->arraySanitize($data);
        $dateValid = $this->validateDate($sanitizedData['date']);
        $periodValid = $this->respectStringLength($sanitizedData['period'], 80);


        if (!$dateValid) {
            $this->responseWithError(400, "Le format de la date de début de cours n'est pas valide");
            exit();
        }

        if (!$periodValid) {
            $this->responseWithError(400, "Le nom de la période de cours ne doit pas dépasser 80 lettres");
            exit();
        }

        $createResponse = $this->coursesRepository->create($data);
        http_response_code(201);
        header('Content-Type: application/json');
        $jsonData = json_encode(['created' => $createResponse, 'message' => 'Le cours a bien été créé', 'course' => $data]);
        echo $jsonData;
        exit();
    }

    public function update($id, $data)
    {
        $data = json_decode($data, true);
        $dataValid = $this->allDataSetNotEmpty($data);

        if (!$dataValid['valid']) {
            http_response_code(400);
            header('Content-Type: application/json');
            $jsonData = json_encode(['updated' => false, 'message' => $dataValid['message'], 'course' => $data]);
            echo $jsonData;
            exit();
        }

        $sanitizedData = $this->arraySanitize($data);
        $dateValid = $this->validateDate($sanitizedData['date']);
        $periodValid = $this->respectStringLength($sanitizedData['period'], 80);

        if (!$dateValid) {
            $this->responseWithError(400, "Le format de la date de début de cours n'est pas valide");
            exit();
        }

        if (!$periodValid) {
            $this->responseWithError(400, "Le nom de la période de cours ne doit pas dépasser 80 lettres");
            exit();
        }

        $updateResponse = $this->coursesRepository->update($id, $data);
        if ($updateResponse) {
            http_response_code(200);
            header('Content-Type: application/json');
            $jsonData = json_encode(['updated' => true, 'message' => 'Le cours a bien été mis à jour', 'course' => $data]);
            echo $jsonData;
        } else {
            $this->responseWithError(404, "Le cours avec l'ID $id n'existe pas");
        }
        exit();
    }

    public function delete($id)
    {
        $deleteResponse = $this->coursesRepository->delete($id);
        if ($deleteResponse) {
            http_response_code(200);
            header('Content-Type: application/json');
            $jsonData = json_encode(['deleted' => true, 'message' => 'Le cours a bien été supprimé']);
            echo $jsonData;
        } else {
            $this->responseWithError(404, "Le cours avec l'ID $id n'existe pas");
        }
        exit();
    }
}
