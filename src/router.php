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

        default:
        $notFoundController->notFoundPage;

}

?>