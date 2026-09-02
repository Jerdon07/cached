<?php

namespace App;

enum StockTransferStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Approved = 'approved';
    case InTransit = 'in_transit';
    case Received = 'received';
    case Cancelled = 'cancelled';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Transfer is being prepared but has not been submitted',
            self::Pending => 'Transfer has been submitted and is waiting for approval',
            self::Approved => 'Transfer was approved and can now be processed',
            self::InTransit => 'Items have left the source warehouse and are being transported',
            self::Received => 'Destination warehouse has confirmed receipt',
            self::Cancelled => 'Transfer was cancelled before completion',
            self::Rejected => 'Manager rejected the transfer request',
        };
    }
}
