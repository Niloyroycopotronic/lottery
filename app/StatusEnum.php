<?php

namespace App;

enum StatusEnum: int
{
    case ACTIVE  = 1;
    case DEACTIVE = 0;

    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    public function isDeactive(): bool
    {
        return $this === self::DEACTIVE;
    }

    public function getLebelText(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::DEACTIVE => 'Deactive'
        };
    }

    public function getLebelReform(): string
    {
        return match ($this) {
            self::ACTIVE => 'Deactive',
            self::DEACTIVE => 'Active'
        };
    }
}
