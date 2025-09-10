<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'instansi',
        'tipe',
        'nama_proyek',
        'deskripsi',
        'kuantitas',
        'tenggat',
        'budget',
        'desain',
        'status',
        'catatan',
        'user_id',

        // Kolom terkait Midtrans (tambahan)
        'midtrans_order_id',   // ORDER-{id}-{timestamp}
        'payment_info',        // JSON ringkasan metode bayar
        'midtrans_tx_status',  // status terakhir dari Midtrans (pending/settlement/expire/...)
    ];

    /**
     * Casting kolom.
     */
    protected $casts = [
        'payment_info' => 'array',
        'tenggat'      => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * Relasi ke User (pemilik order).
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Label metode pembayaran yang enak dibaca admin.
     * Contoh output: "BCA VA", "QRIS", "GoPay", "Alfamart", "Kartu (Credit)"
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        $pi = (array) ($this->payment_info ?? []);
        $channel = strtolower($pi['channel'] ?? $pi['payment_type'] ?? '');
        if ($channel === '') return '-';

        $map = [
            'bca_va'       => 'BCA VA',
            'bni_va'       => 'BNI VA',
            'bri_va'       => 'BRI VA',
            'cimb_va'      => 'CIMB VA',
            'permata_va'   => 'Permata VA',
            'mandiri_bill' => 'Mandiri Bill (E-Channel)',
            'qris'         => 'QRIS',
            'gopay'        => 'GoPay',
            'shopeepay'    => 'ShopeePay',
            'indomaret'    => 'Indomaret',
            'alfamart'     => 'Alfamart',
            'cc_credit'    => 'Kartu (Credit)',
            'cc_debit'     => 'Kartu (Debit)',
            'cstore'       => 'Convenience Store',
        ];

        return $map[$channel] ?? strtoupper($channel);
    }

    /**
     * Identitas instrumen pembayaran ringkas.
     * - VA: "VA BCA • ****1234"
     * - CStore: "INDOMARET • Code 123456789"
     * - Kartu: "Kartu 4811-11**-****-1234 (CREDIT)"
     */
    public function getPaymentIdentityAttribute(): ?string
    {
        $pi = (array) ($this->payment_info ?? []);

        if (!empty($pi['va_last4']) && !empty($pi['bank'])) {
            return 'VA ' . strtoupper($pi['bank']) . ' • ****' . $pi['va_last4'];
        }

        if (!empty($pi['payment_code']) && !empty($pi['store'])) {
            return strtoupper($pi['store']) . ' • Code ' . $pi['payment_code'];
        }

        if (!empty($pi['masked_card'])) {
            $jenis = strtoupper($pi['card_type'] ?? 'CREDIT');
            return 'Kartu ' . $pi['masked_card'] . ' (' . $jenis . ')';
        }

        return null;
        }
}
