<?php

namespace App\Support\Filament\Enums;

enum ActionType: string
{
    case Page = 'page';
    case Table = 'table';
    case TableBulk = 'table_bulk';
}
