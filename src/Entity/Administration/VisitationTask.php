<?php

namespace App\Entity\Administration;

use App\Entity\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitationTaskRepository")
 */
class VisitationTask
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $specialistId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function returnArray()
    {
        return [
            'createdAt'=>$this->createdAt,
            'updatedAt'=>$this->updatedAt,
            'clientId'=>$this->userId,
            'status'=>$this->status,
            'specialistId'=>$this->specialistId,
        ];
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSpecialistId(): ?int
    {
        return $this->specialistId;
    }

    public function setSpecialistId(int $specialistId): self
    {
        $this->specialistId = $specialistId;

        return $this;
    }
}
