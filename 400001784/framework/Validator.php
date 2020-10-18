<?php
    class Validator
    {
        public static function validEmail($email):bool
        {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                return false;
            }
            return true;
        }

        public static function validPassword($password):bool
        {
            if(strlen($password) < 10)
            {
                return false;
            }elseif(!preg_match('/[A-Z]/', $password))
            {
               return false;
            }else if(!preg_match('/\d/',$password)){
                return false;
            }
            return true;
        }
        public static function validRePassword($password,$repassword)
        {
            if($password == $repassword)
            {
                return true;
            }
            return false;
        }

    }
?>