<?php

namespace App\Enums;

enum BookStatus: string
{
    case AVAILABLE = 'AVAILABLE';
    case BORROWED = 'BORROWED';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::BORROWED => 'Borrowed',
        };
    }

}