<?php  
    class LoginController extends Controller
    {
        public function run():void
        {
            $this->setModel(new LoginModel());
		    $this->setView(new View);
		    $this->getView()->setTemplate("tpl/login.tpl.php");
		    $this->getView()->display();
        }
    }
 
?>