<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    private $roles = 'ROLE_ADMIN';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
      return ['ROLE_ADMIN', 'ROLE_USER'];
    }


    public function getSalt()
    {
      return Null;
    }

    public function eraseCredentials()
    {
        
    }
    
    public function serialize()
    {
      return serialize([
        $this->id, 
        $this->username,
        $this->password
      ]);
    }

    public function unserialize($serialized)
    { 
      list (
        $this->id, 
        $this->username,
        $this->password
      ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    
    public function getUserIdentifier(): string
    {
      return $this->username;
    }
}
