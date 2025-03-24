<?php
class Contact {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $source;

    public function __construct($firstName, $lastName, $email, $phone, $source) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->source = $source;
    }

    // Getters and setters for each field

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getSource() {
        return $this->source;
    }

    public function setSource($source) {
        $this->source = $source;
    }
}
