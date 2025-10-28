<?php

namespace App\Helpers;

use App\Models\Product;

class BarcodeHelper
{
    public static function generateBarcode()
    {
        do {
            $barcode = 'P' . str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (Product::where('barcode', $barcode)->exists());

        return $barcode;
    }
}