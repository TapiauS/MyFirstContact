<?php

class User{

    private String $pseudo;

    private String $password;

    private int $id;

    public function __construct(String $pseudo,String $password,int $id)
    {
        $this->setId($id);
        $this->setPseudo($pseudo);
        $this->setPassword($password);
    }

    

    /**
     * Get the value of pseudo
     *
     * @return String
     */
    public function getPseudo(): String
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param String $pseudo
     *
     * @return self
     */
    public function setPseudo(String $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return String
     */
    public function getPassword(): String
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param String $password
     *
     * @return self
     */
    public function setPassword(String $password): self
    {
        $this->password = $password;

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