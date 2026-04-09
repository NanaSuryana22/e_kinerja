<?php

namespace App\Services;

class KinerjaService
{
    /**
     * Menghitung total skor berdasarkan bobot dan nilai.
     * * @param float|int $bobot
     * @param float|int $nilai
     * @return float|int
     */
    public function hitungSkor($bobot, $nilai)
    {
        // Pastikan nilai tidak null untuk menghindari error matematika
        $nilai = $nilai ?? 0;
        $bobot = $bobot ?? 0;

        return $bobot * $nilai;
    }
}