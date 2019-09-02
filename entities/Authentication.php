<?php



/**
 * Authentication
 */
class Authentication
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $passwordHash;

    /**
     * @var int
     */
    private $id;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Authentication
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set passwordHash.
     *
     * @param string|null $passwordHash
     *
     * @return Authentication
     */
    public function setPasswordHash($passwordHash = null)
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * Get passwordHash.
     *
     * @return string|null
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
