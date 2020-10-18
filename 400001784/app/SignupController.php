<?php  
    class SignupController extends Controller
    {
        public function run():void
        {
            if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["controller"] == "SignUp")
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

                $this->setModel(new UsersModel);
                $this->setView(new View);
                $this->getView()->setTemplate("tpl/signup.tpl.php");
                $user = $this->getModel()->getAll();
                $errors = array();
                if(!Validator::validEmail($email))
                {
                    array_push($errors,"Invalid Email");
                }
                if(!Validator::validPassword($pass))
                {
                    array_push($errors,"Invalid Password Format/Length");
                }
                if(!Validator::validRePassword($pass,$repass))
                {
                    array_push($errors,"Invalid Passwords Do Not Match!");
                }
                if(!isset($_POST["check"]))
                {
                    array_push($errors,"Terms Must Be Agreed To");
                }

                if($errors == array())
                {
                   SessionClass::create();
                   SessionClass::add("success","Sign Up Successful. Please login below");
                   $newUser = array(
                        "name" => $name,
                        "email" => $email,
                        "password" => password_hash($pass, PASSWORD_DEFAULT)
                   );
                   $user = $this->getModel()->update($newUser);
                   header("Location:index.php?controller=Login");
                }
                else
                {
                    $this->getView()->addVar("errors",$errors);
                    $this->getView()->display();
                }
            
            }
        }
    }
?>