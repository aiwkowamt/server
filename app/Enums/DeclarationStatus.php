<?php

namespace App\Enums;

enum DeclarationStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

//    const isInProcessStatuses = [
//        self::PENDING, self::COMPLETED
//    ];
//
//    public function isInProcess()
//    {
//        if (in_array($this->value), self::isInProcessStatuses) {
//            return true;
//        }
//        return false;
//    }

}
