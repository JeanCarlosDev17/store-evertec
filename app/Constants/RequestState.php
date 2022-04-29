<?php

namespace App\Constants;

class RequestState
{
    public const APPROVED = 'APPROVED';
    public const PENDING = 'PENDING';
    public const REJECTED = 'REJECTED';

    public function toArray(): array
    {
        return [
            self::APPROVED,
            self::PENDING,
            self::REJECTED,
        ];
    }
}
