<?php

namespace App\Constants;


enum MetodePembayaran: string {
    case COD = 'cod';
    case TRANSFER = 'transfer';

    public static function values(): array { 
        return array_map(fn($case) => $case->value, self::cases());
    }

}
