<?php
    require "framework/autoloader.php";
    $IndexController = new IndexController();
    $LoginController = new LoginController();
    $ProfileController = new ProfileController();
    $SignupController = new SignupController();
    $StreamsController = new StreamsController();
    $AboutUsController = new AboutUsController();

    $LoginModel = new LoginModel();

    if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET == null)
    {
        $IndexController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Login")
    {
        $LoginController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "POST" && $_GET["controller"] == "LoginUser")
    {
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $users = $LoginModel->getAll();
        foreach( $users as $user )
        {
            if($email == $user["email"] && password_verify($pass,$user["password"]))
            {
                $ProfileController->run();
            }
        }
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "LogOut")
    {
        SessionClass::remove("LoggedIn");
        SessionClass::destroy();
        $IndexController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "SignUp")
    {
        $SignupController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Streams")
    {
        $StreamsController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "AboutUs")
    {
        $AboutUsController->run();
    }
?>