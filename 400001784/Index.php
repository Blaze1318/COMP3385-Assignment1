<?php
    require "framework/autoloader.php";
    SessionClass::create();

    $IndexController = new IndexController();
    $LoginController = new LoginController();
    $ProfileController = new ProfileController();
    $SignupController = new SignupController();
    $StreamsController = new StreamsController();
    $AboutUsController = new AboutUsController();
    $CoursesController = new CoursesController();

    if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET == null)
    {
        $IndexController->run();
    }
    elseif(($_SERVER["REQUEST_METHOD"] === "GET"|| $_SERVER["REQUEST_METHOD"] === "POST") && $_GET["controller"] == "Login")
    {
       if(isset($_SESSION["LoggedIn"]))
       {
            if(SessionClass::accessible($_SESSION["LoggedIn"],"login.php"))
            {
                $LoginController->run();
            }
            else
            {
                header("Location:index.php");
            }
       }
       $LoginController->run();
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Profile")
    {
        if(isset($_SESSION["LoggedIn"]))
        {
             if(SessionClass::accessible($_SESSION["LoggedIn"],"profile.php"))
             {
                 
                 $ProfileController->run();
             }
             else
             {
              
               header("Location:index.php");
             }
        }
        else{
            header("Location:index.php");
        }
    }
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "LogOut")
    {
        SessionClass::remove("LoggedIn");
        SessionClass::destroy();
        $IndexController->run();
    }
    elseif(($_SERVER["REQUEST_METHOD"] === "GET"|| $_SERVER["REQUEST_METHOD"] === "POST") && $_GET["controller"] == "SignUp")
    {
       if(isset($_SESSION["LoggedIn"]))
       {
            if(SessionClass::accessible($_SESSION["LoggedIn"],"signup.php"))
            {
                $SignupController->run();
            }
            else
            {
                header("Location:index.php");
            }
       }
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
    elseif($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Courses")
    {
        if(isset($_SESSION["LoggedIn"]))
       {
            if(SessionClass::accessible($_SESSION["LoggedIn"],"courses.php"))
            {
                $CoursesController->run();
            }
            else
            {
                header("Location:index.php");
            }
       }
       else{
             header("Location:index.php");
       }
     
    }
?>