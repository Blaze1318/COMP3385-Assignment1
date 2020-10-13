<?php
    require "framework/autoloader.php";
    $IndexController = new IndexController();

    if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET == null)
    {
        $IndexController->run();
    }
?>