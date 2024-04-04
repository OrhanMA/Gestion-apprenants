<?php
$highway = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');

$homeController = new HomeController();
// $loginController = new LoginController();
// $coursesController = new CoursesController();
$rolesController = new RolesController();
$promotionsController = new PromotionsController();
$usersController = new UsersController();
// $notFoundController = new NotFoundController();


// print_r($highway);
// echo '<br/>';
// print_r(PROMOTIONS_API);

switch ($highway) {
    case HOME_PAGE:
        $homeController->index();
        break;
        // case LOGIN_API:
        // //////
        // break;

        // case COURSES_API:
        // //////
        // break;
    case str_starts_with($highway, PROMOTIONS_API_UPDATE);
        $id = explode('/', $highway)[5];
        $promotionsController->update($data, $id);
        break;
    case str_starts_with($highway, PROMOTIONS_API_DELETE);
        $id = explode('/', $highway)[5];
        $promotionsController->delete($id);
        break;
    case ROLES_API:
        if ($method == 'GET') {
            $rolesController->index();
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
    case str_starts_with($highway, USERS_API_UPDATE):
        $id = explode('/', $highway)[5];
        if ($method == 'GET') {
            echo "error";
        } elseif ($method == 'POST') {
            $usersController->update($data, $id);
        }
        break;
    case str_starts_with($highway, USERS_API_DELETE):
        $id = explode('/', $highway)[5];
        if ($method == 'GET') {
            echo "error";
        } elseif ($method == 'POST') {
            $usersController->delete($id);
        }
    default:
        $homeController->pageNotFound();
        break;
}
