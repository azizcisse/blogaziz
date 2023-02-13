<?php

namespace App\Model; 

use DateTimeInterface;
use App\Model\TimestampedInterface;

Interface TimestampedInterface 
{
    public function getCreatedAt(): ? \DateTimeInterface;

    public function setCreatedAt(DateTimeInterface $createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt(?\DateTimeInterface $updatedAt);
    
}