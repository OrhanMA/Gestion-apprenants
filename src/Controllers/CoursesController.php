<?php

class CoursesController {

    use Validations;

    private $coursesRepository;
    
    public function __construct() {
        $this->coursesRepository = new CoursesRepository();
    }
    
    public function index() {

        $courses = $this->coursesRepository->getAll();

        http_response_code(200);

        header('Content-Type: application/json');

        $jsonData = json_encode($courses);

        echo$jsonData;
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
}