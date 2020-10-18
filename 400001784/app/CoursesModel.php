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

	public function getCourseInstructors():array
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/course_instructor.json");
		return json_decode($data,true);
	}

	public function getInstructors():array
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/instructors.json");
		return json_decode($data,true);
	}

	public function getAllCourses():array
	{
		$courses = $this->getAll();
		$course_instructors = $this->getCourseInstructors();
		$instructors = $this->getInstructors();
		$facultyDepartments = $this->getFacultyDepartments();
		$facultyDeptCourses = $this->getFacultyDepartmentCourses();

		for ($i=0; $i < sizeof($courses); $i++)
		{ 
			for ($j=0; $j < sizeof($course_instructors); $j++) 
			{ 
				for ($k=0; $k < sizeof($instructors); $k++)
				{ 
					if ($courses[$i]["course_id"] == $course_instructors[$j]["course_id"] && $course_instructors[$j]["instructor_id"] == $instructors[$k]["instructor_id"]) 
					{
						$courses[$i]["instructor_name"] = $instructors[$k]["instructor_name"];
					}
				}
			}
		}

		for ($i=0; $i < sizeof($courses); $i++) { 
			for ($j=0; $j < sizeof($facultyDeptCourses); $j++) { 
				for ($k=0; $k < sizeof($facultyDepartments); $k++) { 
					if ($courses[$i]["course_id"] == $facultyDeptCourses[$j]["course_id"] && $facultyDeptCourses[$j]["faculty_dept_id"] == $facultyDepartments[$k]["faculty_dept_id"]) 
					{
						$courses[$i]["faculty_dept_name"] = $facultyDepartments[$k]["faculty_dept_name"];
					}
				}
			}
		}

		return $courses;
	}

	public function getFacultyDepartmentCourses()
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/faculty_dept_courses.json");
		return json_decode($data,true);
	}

	public function getFacultyDepartments()
	{
		$data = file_get_contents($this->absolutePath . "/" ."data/faculty_department.json");
		return json_decode($data,true);
	}

	public function getMostPopular():array
	{
		$popular = $this->getAll();
		$course_instructors = $this->getCourseInstructors();
		$instructors = $this->getInstructors();

		for ($i=0; $i < sizeof($popular); $i++) { 
			for ($j=0; $j < sizeof($course_instructors); $j++) { 
				for ($k=0; $k < sizeof($instructors); $k++) { 
					if ($popular[$i]["course_id"] == $course_instructors[$j]["course_id"] && $course_instructors[$j]["instructor_id"] == $instructors[$k]["instructor_id"]) {
						$popular[$i]["instructor_name"] = $instructors[$k]["instructor_name"];
					}
				}
			}
		}
		usort($popular,function($a,$b){
			return strnatcasecmp($a['course_access_count'],$b['course_access_count']);
		});
		return array_slice(array_reverse($popular),0,8);
		
	}

	public function getRecommended():array
	{
		$popular = $this->getAll();
		$course_instructors = $this->getCourseInstructors();
		$instructors = $this->getInstructors();

		for ($i=0; $i < sizeof($popular); $i++) { 
			for ($j=0; $j < sizeof($course_instructors); $j++) { 
				for ($k=0; $k < sizeof($instructors); $k++) { 
					if ($popular[$i]["course_id"] == $course_instructors[$j]["course_id"] && $course_instructors[$j]["instructor_id"] == $instructors[$k]["instructor_id"]) {
						$popular[$i]["instructor_name"] = $instructors[$k]["instructor_name"];
					}
				}
			}
		}
		usort($popular,function($a,$b){
			return strnatcasecmp($a['course_recommendation_count'],$b['course_recommendation_count']);
		});
		return array_slice(array_reverse($popular),0,8);
	}
}

?>
