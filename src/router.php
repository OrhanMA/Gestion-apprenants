<?php
$highway = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];





// $homeController = new HomeController();
// $loginController = new LoginController();
// $coursesController = new CoursesController();
// $rolesController = new RolesController();
// $promotionsController = new PromotionsController();
$usersController = new UsersController();
// $notFoundController = new NotFoundController();

switch ($highway) {
        // case HOME_PAGE:
        
        // break;

        // case LOGIN_API:
        // //////
        // break;

        // case COURSES_API:
        // //////
        // break;

        // case ROLES_API:
        // //////
        // break;

        // case PROMOTIONS_API:
        // //////
        // break;

        case USERS_API:
        if($method == 'GET') {
            $usersController->index();
        }elseif ($method == 'POST') {
            $data = file_get_contents('php://input');
            $usersController->create($data);
        }
        break;

        case USERS_API_UPDATE:
            if($method == 'GET') {
                echo"error";
            } elseif($method == 'POST') {
                $usersController->update($data, $id);
            }
        break;
        
        case USERS_API_DELETE:
            if($method == 'GET') {
                echo"error";
            } elseif($method == 'POST') {
                $usersController->delete($id);
            }

        // default:
        
        // 404

}

?>