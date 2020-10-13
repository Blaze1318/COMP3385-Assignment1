<?php  
 
class StreamsController extends Controller
{ 
	public function run():void
	{
		$this->setModel(new StreamsModel());
		$this->setView(new View);
		$this->getView()->setTemplate("tpl/streams.tpl.php");
		$this->getModel()->attach($this->getView());
		$this->getModel()->setData($this->getModel()->getStreams());
		$this->getModel()->notify();
		$this->getView()->display();
	}
}

?>