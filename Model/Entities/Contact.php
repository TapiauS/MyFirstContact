<?php

class Contact{
    private ?String $lastName;

    private ?String $firstName;

    private String $email;

    private ?String $phone;

    private ?DateTime $birthDate;

    private ?String $picturePath;

    private int $id;

    public function __construct(?String $lastName,?String $firstName,String $email,
                                ?String $phone,?DateTime $birthDate,?String $picturePath,int $id){
        $this->setLastName($lastName);
        $this->setFirstName($firstName);
        $this->setEmail($email);
        $this->setBirthDate($birthDate);
        $this->setPhone($phone);
        $this->setPicturePath($picturePath);
        $this->setId($id);
    }

    /**
     * Get the value of firstName
     *
     * @return ?String
     */
    public function getFirstName(): ?String
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param ?String $firstName
     *
     * @return self
     */
    public function setFirstName(?String $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return String
     */
    public function getEmail(): String
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param String $email
     *
     * @return self
     */
    public function setEmail(String $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     *
     * @return ?String
     */
    public function getPhone(): ?String
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param ?String $phone
     *
     * @return self
     */
    public function setPhone(?String $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of birthDate
     *
     * @return ?DateTime
     */
    public function getBirthDate(): ?DateTime
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @param ?DateTime $birthDate
     *
     * @return self
     */
    public function setBirthDate(?DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of picturePath
     *
     * @return ?String
     */
    public function getPicturePath(): ?String
    {
        return $this->picturePath;
    }

    /**
     * Set the value of picturePath
     *
     * @param ?String $picturePath
     *
     * @return self
     */
    public function setPicturePath(?String $picturePath): self
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return ?String
     */
    public function getLastName(): ?String
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param ?String $lastName
     *
     * @return self
     */
    public function setLastName(?String $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    private function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}