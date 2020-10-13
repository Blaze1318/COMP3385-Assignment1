<?php
     class StreamsModel extends Model
     {
        public function getAll(): array
        {
            $data = file_get_contents($this->absolutePath . "/" ."data/streams.json");
            return json_decode($data,true);
        }
    
        public function getRecord(string $id):array
        {
            $data = file_get_contents($this->absolutePath . "/" ."data/streams.json");
            $jsondata = json_decode($data,true);
    
            foreach ($jsondata as $key) {
                if ($key["course_id"] == $id) {
                    return $key;
                }
            }
            return [];
        }
    
        public function getStreamInstructors():array
        {
            $data = file_get_contents($this->absolutePath . "/" ."data/stream_instructor.json");
            return json_decode($data,true);
        }
    
        public function getInstructors():array
        {
            $data = file_get_contents($this->absolutePath . "/" ."data/instructors.json");
            return json_decode($data,true);
        }

        public function getStreams():array
        {
            $streams = $this->getAll();
            $stream_instructors = $this->getStreamInstructors();
            $instructors = $this->getInstructors();

            for ($i=0; $i < sizeof($streams); $i++) { 
                for ($j=0; $j < sizeof($stream_instructors); $j++) { 
                    for ($k=0; $k < sizeof($instructors); $k++) { 
                        if ($streams[$i]["stream_id"] == $stream_instructors[$j]["stream_id"] && $stream_instructors[$j]["instructor_id"] == $instructors[$k]["instructor_id"]) {
                            $streams[$i]["instructor_name"] = $instructors[$k]["instructor_name"];
                        }
                    }
                }
            }
            return $streams;
        }
      }
?>