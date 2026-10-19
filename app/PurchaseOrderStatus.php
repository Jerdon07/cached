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
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Order is being created and can still be edited',
            self::Pending => 'Order has been submitted and is waiting for approval',
            self::Approved => 'Manager approved the order and will be delivered',
            self::Rejected => 'Manager rejected the order',
            self::Cancelled => 'Order was cancelled before being delivered',
            self::PartiallyReceived => 'Received some of the purchased orders',
            self::Closed => 'Order has been closed',
        };
    }
}
