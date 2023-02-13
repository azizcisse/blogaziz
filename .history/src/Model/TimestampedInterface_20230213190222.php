<?php

namespace App\Model; 

use App\Model\TimestampedInterface;

Interface TimestampedInterface 
{
    public function getCreatedAt();

    public function setCreatedAt(\DateTimeInterface $createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt(?\DateTimeInterface $updatedAt);
    
}