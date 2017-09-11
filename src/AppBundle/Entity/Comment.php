<?php

/*
 * This file is part of the TestVagrant Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 *
 * @ORM\Entity(repositoryClass="")
 * @ORM\Table(name="comments")
 */
class Comment
{
    const STATUS_ENABLED  = true;
    const STATUS_DISABLED = true;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $status;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    protected $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Comment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Comment
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return array
     */
    public static function getAvailableStatus()
    {
        return [
            self::STATUS_DISABLED,
            self::STATUS_ENABLED,
        ];
    }
}
