<?php  
    class LoginController extends Controller
    {
        public function run():void
        {
            if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "Login")
            {
                $this->setView(new View);
                $this->getView()->setTemplate("tpl/login.tpl.php");
                $this->getView()->display();
            }
            elseif($_SERVER["REQUEST_METHOD"] === "POST" && $_GET["controller"] == "Login")
            {
                $email = $_POST["email"];
                $pass = $_POST["password"];
                $this->setModel(new UsersModel);
                $this->setView(new View);
                $this->getView()->setTemplate("tpl/login.tpl.php");
                $user = $this->getModel()->getRecord($email);
                if($user == array())
                {
                    $this->getView()->addVar("loginError","Invalid email/password");
                    $this->getView()->display();
                }
                elseif(!password_verify($pass,$user["password"]))
                {
                    $this->getView()->addVar("loginError","Invalid email/password");
                    $this->getView()->display();
                }
                else
                {
                    SessionClass::create();
                    SessionClass::add("LoggedIn",$user["email"]);
                    header("Location:index.php?controller=Profile");
                }
            }
        }
    }
 
?>