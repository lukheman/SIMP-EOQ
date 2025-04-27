<?php

namespace App\Constants;

enum StatusTransaksi: string
{
    case PENDING = 'pending';
    case DIPROSES = 'diproses';
    case DIKIRIM = 'dikirim';
    case DITOLAK = 'ditolak';
    case SELESAI = 'selesai';
    case BATAL = 'batal';
}
