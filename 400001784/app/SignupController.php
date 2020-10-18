<?php  
    class SignupController extends Controller
    {
        public function run():void
        {
            $this->setModel(new SignupModel());
		    $this->setView(new View);
		    $this->getView()->setTemplate("tpl/signup.tpl.php");
            $this->getView()->display();
            

            if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "SignUP")
            {
                $this->setView(new View);
                $this->getView()->setTemplate("tpl/signup.tpl.php");
                $this->getView()->display();
            }
            elseif($_SERVER["REQUEST_METHOD"] === "POST" && $_GET["controller"] == "SignUp")
            {
                $name = $_POST["formFullName"];
                $email = $_POST["email"];
                $pass = $_POST["password"];
                $repass = $_POST["repassword"];
                $check = $_POST["check"];
                $this->setModel(new UsersModel);
                $this->setView(new View);
                $this->getView()->setTemplate("tpl/signup.tpl.php");
                $user = $this->getModel()->getRecord($email);
                if($user == array())
                {
                    $this->getView()->addVar("signupError","Invalid email/password");
                    $this->getView()->display();
                }
                elseif(!password_verify($pass,$user["password"]))
                {
                    $this->getView()->addVar("signupError","Invalid email/password");
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