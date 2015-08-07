<?php
    //4 space tabs were used because I am told that is PHP convention, although
    //I prefer 2. I personally prefer the style of the opening curly brace on the
    //same line as the word Class or function. I am not sure if there is a
    //standard convention there?
    class Contact {
        //private properties
        private $name;
        private $phone;
        private $address;


        //I still don't full understand the purpose of the constructor other than
        //all of the private variables above need to be passed thru with this syntax.
        function __construct($name, $phone, $address) {
            $this->name = $name;
            $this->phone = $phone;
            $this->address = $address;
        }


        //getters
        function getName() {
            return $this->name;
        }

        function getPhone() {
            return $this->phone;
        }

        function getAddress() {
            return $this->address;
        }


        //setters
        function setName($new_name) {
            $this->name = (string) $new_name;
        }

        function setPhone($new_phone) {
            $this->phone = (string) $new_phone;
        }

        function setAddress($new_address) {
            $this->address = (string) $new_address;
        }


        //save method
        function save () {
            array_push($_SESSION['list_of_contacts'], $this);
        }

        //getAll method - what exactly does static mean and why does getAll() and
        //deleteAll() have to be static?
        static function getAll() {
            return $_SESSION['list_of_contacts'];
        }

        //deleteAll method
        static function deleteAll() {
            $_SESSION['list_of_contacts'] = array();
        }

    }

?>
