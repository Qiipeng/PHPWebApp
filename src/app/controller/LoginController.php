<?php

namespace app\controller;

use frame\mvc\BaseController;
use app\model\UserModel;

/**
 * Class LoginController
 * @package app\controller
 * @author 斉鵬
 */
class LoginController extends BaseController
{
    /**
     * Login.
     */
    public function login()
    {
        $account = $_POST["account"];
        $password = $_POST["password"];

        $user = (new UserModel)->where([" name = ? ", " and password = ? ",
            " or email = ? ", " and password = ? "],
            [$account, $password, $account, $password])->fetch();

        if ($user) {
            session_start();

            $_SESSION["userid"] = $user["id"];
            $_SESSION["username"] = $user["name"];

            header("Location: http://localhost:8080/blog");
        } else {
            header("Location: http://localhost:8080/login.html");
        }
    }

    /**
     * Logout.
     */
    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: http://localhost:8080/login.html");
    }
}