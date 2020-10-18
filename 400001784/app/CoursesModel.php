<?php 

class CoursesModel extends Model
{
	public function getAll(): array
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/courses.json");
		return json_decode($data,true);
	}

	public function getRecord(string $id):array
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/courses.json");
		$jsondata = json_decode($data,true);

		foreach ($jsondata as $key) {
			if ($key["course_id"] == $id) {
				return $key;
			}
		}
		return [];
	}
	
}

?>
