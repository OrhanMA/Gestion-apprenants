<?php
$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');

$homeController = new HomeController();
$coursesController = new CoursesController();
$rolesController = new RolesController();
$promotionsController = new PromotionsController();
$usersController = new UsersController();
$authController = new AuthController();


switch ($route) {
    case HOME_PAGE:
        $homeController->index();
        break;
    case AUTH_CHECK_EMAIL:
        if ($method == "POST") {
            $authController->checkExisitingEmail($data);
        }
        break;
    case AUTH_CREATE_PASSWORD:
        if ($method == "POST") {
            $authController->createPassword($data);
        }
        break;
    case AUTH_LOGIN:
        if ($method == "POST") {
            $authController->login($data);
        }
        break;
    case AUTH_LOGOUT:
        if ($method == "GET") {
            $authController->logout();
        }
        break;
    case COURSES_API:
        if ($method == "GET") {
            $coursesController->index();
        }
        if ($method == "POST") {
            $coursesController->getUserCourses($data);
        }
        break;
    case COURSES_API_SIGN:
        if ($method == "POST") {
            $coursesController->signUserCourse($data);
        }
        break;
    case str_starts_with($route, PROMOTIONS_API_UPDATE);
        $id = explode('/', $route)[5];
        $promotionsController->update($data, $id);
        break;
    case str_starts_with($route, PROMOTIONS_API_DELETE);
        $id = explode('/', $route)[5];
        $promotionsController->delete($id);
        break;
    case ROLES_API:
        if ($method == 'GET') {
            $rolesController->index();
        }
        break;
    case str_starts_with($route, PROMOTIONS_API . "/"):
        if ($method == 'GET') {
            $id = explode('/', $route)[4];
            $promotionsController->getById($id);
        }
        break;
    case PROMOTIONS_API:
        if ($method == 'GET') {
            $promotionsController->index();
        } else if ($method == 'POST') {
            $promotionsController->create($data);
        }
        break;
    case USERS_API:
        if ($method == 'GET') {
            $usersController->index();
        } elseif ($method == 'POST') {
            $usersController->create($data);
        }
        break;
    case str_starts_with($route, USERS_API_UPDATE):
        $id = explode('/', $route)[5];
        if ($method == 'GET') {
            echo "error";
        } elseif ($method == 'POST') {
            $usersController->update($data, $id);
        }
        break;
    case str_starts_with($route, USERS_API_DELETE):
        $id = explode('/', $route)[5];
        if ($method == 'GET') {
            echo "error";
        } elseif ($method == 'POST') {
            $usersController->delete($id);
        }
    default:
        $homeController->pageNotFound();
        break;
}
