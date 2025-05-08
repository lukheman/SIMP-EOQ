<?php

namespace App\Constants;

enum Role: string {
    case ADMINTOKO = 'admin_toko';
    case ADMINGUDANG= 'admin_gudang';
    case PEMILIKTOKO = 'pemilik_toko';
    case RESELLER = 'reseller';
    case KURIR = 'kurir';
}
