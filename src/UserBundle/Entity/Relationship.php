<?php

namespace UserBundle\Entity;

class Relationship
{
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'pending';
    const STATUS_DECLINED = 'declined';
    const STATUS_BLOCKED = 'blocked';


    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user_one;

    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user_two;

    /**
     * @ORM\
     */

    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserOne()
    {
        return $this->user_one;
    }

    /**
     * @param mixed $user_one
     */
    public function setUserOne($user_one)
    {
        $this->user_one = $user_one;
    }

    /**
     * @return mixed
     */
    public function getUserTwo()
    {
        return $this->user_two;
    }

    /**
     * @param mixed $user_two
     */
    public function setUserTwo($user_two)
    {
        $this->user_two = $user_two;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}