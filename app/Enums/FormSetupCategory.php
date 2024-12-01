<?php

namespace App\Enums;

enum FormSetupCategory: string
{
    case Performance = 'performance';
    case Bonus = 'bonus';
    case Increment = 'increment';
    case Promotion = 'promotion';
    case Transfer = 'transfer';
}
