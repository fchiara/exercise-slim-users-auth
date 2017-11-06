<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Models\Repository\UserRepository")
 * @ORM\Table(
 *     name="users",
 *     uniqueConstraints={
 *      @ORM\UniqueConstraint(name="idx_unique_username_password", columns={"username", "password"}),
 *      @ORM\UniqueConstraint(name="idx_unique_email", columns={"email"})
 *     },
 *     indexes={
 *      @ORM\Index(name="idx_login", columns={"username", "password"}),
 *      @ORM\Index(name="idx_search", columns={"first_name","last_name","birth_date"})
 *     }
 * )
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", nullable=false)
     */
    protected $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(name="birthday", type="date", nullable=false)
     */
    protected $birthday;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}