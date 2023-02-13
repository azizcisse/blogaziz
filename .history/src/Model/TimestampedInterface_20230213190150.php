<?php

namespace App\Model; 

use App\Model\TimestampedInterface;

Interface TimestampedInterface 
{
    public function getCreatedAt();
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt);

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}