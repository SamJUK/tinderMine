<?php

class tinderWeb{

    private $dataDir  = './data';
    private $usersDir = './data/users';

    private $user;

    function getUsers(){
        $userArray = array();
        $usersFiles = array_diff(scandir($this->usersDir), array('.', '..'));
        foreach($usersFiles as $userFile){
            $jsonString = file_get_contents($this->usersDir . '/' . $userFile);
            $json = json_decode($jsonString, true);
            $user_id = $json['_id'];

            $userArray[$user_id] = $json;
        }
        return $userArray;
    }

    function userExists($id){
        $path = $this->usersDir . '/' . $id . '.json';
        return file_exists($path);
    }

    function user($id){
        $path = $this->usersDir . '/' . $id . '.json';
        $jsonString = file_get_contents($path);
        $json = json_decode($jsonString, true);

        return $json;
    }

    function getName(){
        return $this->user['name'];
    }

    static function getAge($dt){
        $birth_date = new DateTime($dt);
        $now = new DateTime();
        $age = $now->diff($birth_date)->y;

        return $age;
    }
}