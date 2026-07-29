<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppLog extends Model
{
    protected $table = 'whatsapp_logs';

    protected $fillable = [
        'transaction_id',
        'event_id',
        'organization_id',
        'order_id',
        'recipient_phone',
        'provider',
        'status',
        'payload',
        'response',
        'message',
    ];

    protected $casts = [
        'payload' => 'array',
        'response' => 'array',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
