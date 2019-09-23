<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;

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
     * @ORM\Column(name="is_active", type="boolean", options={"default" : 1})
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
            $this->isActive = true;
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

    public function setCreatedAt($date)
    {
        $this->createdAt = $date;
        return null;
    }

    public function setUpdatedAt($date)
    {
        $this->updatedAt = $date;
        return null;
    }
}