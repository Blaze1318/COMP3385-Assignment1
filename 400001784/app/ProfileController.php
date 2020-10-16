<?php
    class ProfileController extends Controller
    {
        public function run():void
        {
              SessionClass::create();
              SessionClass::add("LoggedIn","Yes");
              $this->setModel(new ProfileModel());
		    $this->setView(new View);
		    $this->getView()->setTemplate("tpl/profile.tpl.php");
		    $this->getView()->display();
        }
    }
 
?>