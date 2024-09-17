<?php
class User
{
	//Attributes of a user object
    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $userType;
	
	//A constructor used to create a new instance of an object
    public function __construct($id, $ut, $fn, $ln, $em)
    {
        $this->userID = $id;
        $this->userType = $ut;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->email = $em;
    }
	
	//Getters & Setters function
    function getUserId()
    {
        return $this->userID;
    }

    function setUserId($id)
    {
        $this->userID = $id;
    }

    function getFirstName()
    {
        return $this->firstName;
    }

    function setFirstName($fn)
    {
        $this->firstName = $fn;
    }

    function getLastName()
    {
        return $this->lastName;
    }

    function setLastName($ln)
    {
        $this->lastName = $ln;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($em)
    {
        $this->email = $em;
    }

    function getUserType()
    {
        return $this->userType;
    }

    function setUserType($ut)
    {
        $this->userType = $ut;
    }
}
