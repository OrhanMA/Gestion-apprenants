<?php

$homeController = new HomeController();
$loginController = new LoginController();
$coursesController = new CoursesController();
$rolesController = new RolesController();
$promotionsController = new PromotionsController();
$usersController = new UsersController();
$notFoundController = new NotFoundController();



switch ($highway) {
        case HOME_PAGE:
        //////
        break;

        case LOGIN_PAGE:
        //////
        break;

        case COURSES_PAGE:
        //////
        break;

        case ROLES_PAGE:
        //////
        break;

        case PROMOTIONS_PAGE:
        //////
        break;

        case USERS_PAGE:
        //////
        break;

        default:
        $notFoundController->notFoundPage;

}

?>