<?php  
 
class AboutUsController extends Controller
{ 
	public function run():void
	{
		$this->setView(new View);
		$this->getView()->setTemplate("tpl/aboutus.tpl.php");
		$this->getView()->display();
	}
}

?>