<?php

namespace App;

enum PurchaseOrderStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
    case PartiallyReceived = 'partially_received';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Order is being created and can still be edited',
            self::Pending => 'Order has been submitted and is waiting for approval',
            self::Approved => 'Manager approved the order and can be completed',
            self::Rejected => 'Manager rejected the order',
            self::Cancelled => 'Order was cancelled before completion',
            self::PartiallyReceived => 'Received some of the purchased orders',
            self::Completed => 'Order has been successfully fulfilled',
        };
    }
}
