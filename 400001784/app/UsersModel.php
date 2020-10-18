<?php
   class UsersModel extends Model
   {
        public function getAll(): array
        {
            $data = file_get_contents($this->absolutePath . "/" ."/data/users.json");
            return json_decode($data,true);
        }

        public function getRecord(string $id):array
        {
            $data = file_get_contents($this->absolutePath . "/" ."data/users.json");
            $jsondata = json_decode($data,true);

            foreach ($jsondata as $key) {
                if ($key["email"] == $id) {
                    return $key;
                }
            }
            return [];
        }

        public function update(array $newUser):void{
            $users = $this->getAll();
            array_push($users, $newUser);
            file_put_contents($this->absolutePath . "/" . "data/users.json", json_encode($users));
        }

        public function getUserCourses():array
        {
            $data = file_get_contents($this->absolutePath . "/" ."/data/user_courses.json");
            return json_decode($data,true);
        }
        
        public function getCourses():array
        {
            $courseModel = new CoursesModel();
            $mycourses = $courseModel->getAllCourses();
            $userCourses = $this->getUserCourses();
            $getRegisterCourses = array();

            for ($i=0; $i < sizeof($mycourses); $i++) { 
                for ($j=0; $j < sizeof($userCourses); $j++) { 
                    if ($mycourses[$i]["course_id"] == $userCourses[$j]["course_id"] && $userCourses[$j]["email"] == $_SESSION["LoggedIn"]) {
                        array_push($getRegisterCourses, $mycourses[$i]);
                    }
                }
            }

            return $getRegisterCourses;
        }
    }
?>