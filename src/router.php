<?php
$highway = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];





// $homeController = new HomeController();
// $loginController = new LoginController();
// $coursesController = new CoursesController();
// $rolesController = new RolesController();
$promotionsController = new PromotionsController();
$usersController = new UsersController();
// $notFoundController = new NotFoundController();


// print_r($highway);
// echo '<br/>';
// print_r(PROMOTIONS_API);

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

    case PROMOTIONS_API:
        if ($method == 'GET') {
            $promotionsController->index();
        } else if ($method == 'POST') {
            $data = file_get_contents('php://input');
            $promotionsController->create($data);
        }
        break;

    case USERS_API:
        if ($method == 'GET') {
            $usersController->index();
        } elseif ($method == 'POST') {
            $data = file_get_contents('php://input');
            $usersController->create($data);
        }

        break;

        // default:
        // $notFoundController->notFoundPage;

}

//rooter affichafe page prijcipale
