<?php  
 
class CoursesController extends Controller
{ 
	public function run():void
	{
		$this->setModel(new CoursesModel());
		$this->setView(new View);
		$this->getView()->setTemplate("tpl/courses.tpl.php");
		$this->getModel()->attach($this->getView());
		$this->getModel()->setData($this->getModel()->getAllCourses());
		$this->getModel()->notify();
		$this->getView()->display();
	}
}

?>