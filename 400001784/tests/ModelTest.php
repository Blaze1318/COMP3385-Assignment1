<?php
 require "../framework/autoloader.php";
use PHPunit\Framework\Testcase;

class ModelTest extends Testcase
{
	public function testModelObject()
	{
		$model = new IndexModel();
		$this->assertInstanceOf('Model',$model);
	}

	public function testModelAttach()
	{
		$model = new IndexModel();
		$view = new View();
		$model->attach($view);
		$this->assertEquals($view,$model->getObservers()[0]);
	}

	public function testModelNotify()
	{
		$data = file_get_contents("../data/courses.json");
		$jsonData = json_decode($data,true);
		$model = new IndexModel();
		$view = new View();
		$model->attach($view);
		$model->setData($model->getAll());
		$model->notify();
		$this->assertEquals($jsonData,$view->getObsData()[0]);
	}

	public function testModelDetach()
	{
		$model = new IndexModel();
		$view = new View();
		$model->attach($view);
		$model->detach($view);
		$this->assertEquals(array(),$model->getObservers());
	}

	public function testModelGetAll()
	{
		$data = file_get_contents("../data/courses.json");
		$jsonData = json_decode($data,true);
		$model = new IndexModel();
		$this->assertEquals($jsonData,$model->getAll());
	}

	public function testModelGetRecord()
	{
		$data = file_get_contents("../data/courses.json");
		$jsonData = json_decode($data,true);
		$model = new IndexModel();
		$rand = rand();
		$answer = array();

		foreach ($jsonData as $key) 
		{
			if ($key['course_id'] == $rand) {
				$answer = $key; 
				break;
			}
		}
		$this->assertEquals($answer,$model->getRecord($rand));
	}

	public function testModelSetData()
	{
		$model = new IndexModel();
		$num = [1,2,3,4,5];
		$model->setData($num);
		$this->assertEquals($num,$model->getData());
	}

	public function testModelGetData()
	{
		$model = new IndexModel();
		$num = [1,2,3,4,5];
		$model->setData($num);
		$this->assertEquals($num,$model->getData());
	}

	public function testModelGetObservers()
	{
		$model = new IndexModel();
		$view = new View();
		$model->attach($view);
		$this->assertEquals($view,$model->getObservers()[0]);
	}
}


?>