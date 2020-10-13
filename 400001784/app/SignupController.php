<?php  
    class SignupController extends Controller
    {
        public function run():void
        {
            $this->setModel(new SignupModel());
		    $this->setView(new View);
		    $this->getView()->setTemplate("tpl/signup.tpl.php");
		    $this->getView()->display();
        }
    }
?>