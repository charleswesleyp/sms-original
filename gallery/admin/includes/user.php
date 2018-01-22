

<?php
    class User{


        protected static $db_table = "users";

        protected static $db_table_fields = array('username' , 'password', 'firstname', 'lastname');
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;



        public static function find_all_users()
        {
        global $database;
        $user_set = Self::find_this_query("SELECT * FROM ".Self::$db_table."   ");
        return $user_set;
        }


        public static function find_user_by_id($id){
            global $database;
            $user_by_id_set = Self::find_this_query("SELECT * FROM ".Self::$db_table." WHERE id = $id LIMIT 1");

            return !empty($user_by_id_set) ? array_shift($user_by_id_set) : false;
        }

        public static function find_this_query($sql){
            global $database;
            $result = $database->query($sql);
            $the_object_array = array();

            while($row = mysqli_fetch_array($result)){
                $the_object_array[] = Self::instantiation($row);
            }
            return $the_object_array;
        }


        public static function verify_user($username, $password){
            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM ".Self::$db_table." WHERE `username` = '{$username}' AND `password` = '{$password}' LIMIT 1";
            $the_user_result = Self::find_this_query($sql);
            return !empty($the_user_result) ? array_shift($the_user_result) : false;

        }


        public static function instantiation($found_user){


            $the_object = new Self;
//            $the_object->id         = $found_user['id'];
//            $the_object->username   = $found_user['username'];
//            $the_object->password   = $found_user['password'];
//            $the_object->first_name = $found_user['firstname'];
//            $the_object->last_name  = $found_user['lastname'];

            foreach ($found_user as $attribute => $value){

                if($the_object->has_attribute($attribute)){
                    $the_object->$attribute = $value;
                }
                }
                return $the_object;
            }


            public function has_attribute($attribute){
             $object_properties = get_object_vars($this);
             return array_key_exists($attribute, $object_properties);
            }

            protected function properties(){
                return get_object_vars($this);
                $properties = array();
                foreach (Self::$db_table_fields as $db_fields){

                    if(property_exists($this, $db_fields)){

                    $properties[$db_fields] = $this->$db_fields;
                    }
                }

                return $properties;
            }

            public function create(){
                global $database;

                $properties = $this->properties();

                $sql = "INSERT INTO ".Self::$db_table." ( ".implode(",", array_keys($properties)).")  VALUES (".implode(",", array_values($properties)).")";

                echo $sql;
                if($database->query($sql)){
                    $this->id = $database->insert_id();
                    return true;
                }  else{

                    return false;
                }
            }





                public function save(){

                return isset($this->id) ? $this->update() : $this->create();
                }



            public function update(){

                global $database;

                $sql = "UPDATE ".Self::$db_table." SET username = '". $database->escape_string($this->username)."' ,    password = '". $database->escape_string($this->password)."'   , firstname = '". $database->escape_string($this->first_name)."' , lastname = '". $database->escape_string($this->last_name)."'   WHERE id = ".$database->escape_string($this->id)."  ";
                $database->query($sql);

                return mysqli_affected_rows($database->connection ) ? true : false;

            }


            public function delete(){
                global $database;

                $sql = "DELETE FROM ".Self::$db_table." WHERE id = ". $database->escape_string($this->id) ." LIMIT 1";
                $database->query($sql);

                return mysqli_affected_rows($database->connection ) ? true : false;


            }



        }



    ?>