<?php

namespace App\Constants;

enum Role: string {
    case ADMINTOKO = 'admintoko';
    case ADMINGUDANG= 'admingudang';
    case PEMILIKTOKO = 'pemiliktoko';
    case RESELLER = 'reseller';
    case KURIR = 'kurir';
}
