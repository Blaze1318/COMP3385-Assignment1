<?php
    require "framework/autoloader.php";
    $IndexController = new IndexController();
    $LoginController = new LoginController();
    $SignupController = new SignupController();
    $StreamsController = new StreamsController();
    $AboutUsController = new AboutUsController();

    if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET == null)
    {
        $IndexController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Login")
    {
        $LoginController->run();
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