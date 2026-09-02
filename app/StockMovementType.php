<?php

namespace App;

enum StockMovementType: string
{
    case Sale = 'sale';
    case TransferIn = 'transfer in';
    case TransferOut = 'transfer out';
    case Adjustment = 'adjustment';
    case Return = 'return';
    case Damage = 'damage';
    case Loss = 'loss';
    case CountCorrection = 'count correction';

    public function label(): string
    {
        return match ($this) {
            self::Sale => 'Sale',
            self::TransferIn => 'Transfer In',
            self::TransferOut => 'Transfer Out',
            self::Adjustment => 'Adjustment',
            self::Return => 'Return',
            self::Damage => 'Damage',
            self::Loss => 'Loss',
            self::CountCorrection => 'Count Correction',
        };
    }

    public function isAlwaysNegative(): bool
    {
        return match ($this) {
            self::Sale, self::TransferOut, self::Damage, self::Loss => true,
            default => false,
        };
    }

    public function isAlwaysPositive(): bool
    {
        return match ($this) {
            self::TransferIn, self::Return => true,
            default => false,
        };
    }
}
