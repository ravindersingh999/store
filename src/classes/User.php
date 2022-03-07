<?php
    class User extends DB
    {
        // public $user_id;
        public $username;
        public $password;
        public $email;

        public function __construct($username, $password, $email)
        {
            // $this->user_id = $user_id;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public function addUser(){
            $stmt = DB::getInstance() -> prepare("SELECT email from users");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultArray = $stmt->fetchAll();

            foreach($resultArray as $key=>$value){
                if($value['email'] == $this->email){
                    echo "Alreay exists";
                    return;
                }
            }
            DB::getInstance()->exec("Insert INTO users(username,password,email) VALUES('$this->username','$this->password','$this->email')");
            echo "Added successfully";
            }
    }
?>