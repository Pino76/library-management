<?php

namespace App\DTO;

/**
 *
 */
class UserDTO
{

    /**
     * @var int
     */
    private int $id ;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var int
     */
    private int $role_id ;

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int $role_id
     */
    public function __construct(int $id , string $name, string $email, int $role_id)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setRoleId($role_id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     * @return void
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }



    /**
     * @return array
     */
    public function toArray()
    {
        foreach (get_object_vars($this) as $k => $v)
            is_object($v) ? $res[$k] = $v->toArray() : $res[$k] = $v;
        return $res ?? [];
    }
}
