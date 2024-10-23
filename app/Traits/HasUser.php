<?php

namespace App\Traits;

use App\Models\User;

trait HasUser
{
    private ?User $user  = null;

    public function setUser(?User $user): self
    {
        $this->user    = $user;
        return $this;
    }
}
