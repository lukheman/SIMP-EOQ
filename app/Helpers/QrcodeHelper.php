<?php

namespace App\Helpers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

class QrcodeHelper {
    public static function getQrcodeString($id) {

        $qrCode = new QrCode(
            data: (string)$id,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel:ErrorCorrectionLevel::Low,
            size: 100,
            margin: 10
        );

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $result->getDataUri();

    }
}
