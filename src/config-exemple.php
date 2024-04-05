<?php

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

define("DATABASE_HOST", "");
define("DATABASE_NAME", "");
define("DATABASE_USERNAME", "");
define("DATABASE_PASSWORD", "");

define("BASE_URL", "");
define("HOME_PAGE", BASE_URL . "/home");
define("LOGIN_API", BASE_URL . "/login");
define("COURSES_API", BASE_URL . "/courses");
define("COURSES_API_SIGN", BASE_URL . "/courses/sign_course");
define("ROLES_API", BASE_URL . "/roles");
define("PROMOTIONS_API", BASE_URL . "/promotions");
define("PROMOTIONS_API_UPDATE", PROMOTIONS_API . "/update/");
define("PROMOTIONS_API_DELETE", PROMOTIONS_API . "/delete/");
define("USERS_API", BASE_URL . "/users");
define("USERS_API_UPDATE", USERS_API . "/update/");
define("USERS_API_DELETE", USERS_API . "/delete/");
define("AUTH", BASE_URL . "/auth");
define("AUTH_CHECK_EMAIL", AUTH . "/check_email");
define("AUTH_CREATE_PASSWORD", AUTH . "/create_password");
define("AUTH_LOGIN", AUTH . "/login");
define("AUTH_LOGOUT", BASE_URL . "/logout");
