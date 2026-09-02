<?php

namespace App;

enum SalesOrderStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Approved = 'approved';
    case Processing = 'processing';
    case Ready = 'ready';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Order is being created and can still be edited',
            self::Pending => 'Order has been submitted and is waiting for approval',
            self::Approved => 'Manager approved the order; it can proceed to fulfillment',
            self::Processing => 'Warehouse is preparing/picking the products',
            self::Ready => 'Products have been picked and are ready for release/shipping',
            self::Completed => 'Order has been successfully fulfilled',
            self::Cancelled => 'Order was cancelled before completion',
            self::Rejected => 'Manager rejected the order',
        };
    }
}
