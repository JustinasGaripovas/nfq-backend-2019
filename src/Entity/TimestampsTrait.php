<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TimestampsTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_actice", type="boolean")
     */
    protected $isActive;

    /**
     * @ORM\PrePersist
     * @ORM\PostPersist
     */
    public function persistTimestamps(): void
    {
        $this->updatedAt = new \DateTime('now');
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}