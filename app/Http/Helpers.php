<?php

use App\Models\Bank;
use App\Models\Company;
use App\Models\Item;
use App\Models\ItemInventory;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\InventoryHistory;
use App\Models\ItemDiscount;
use App\Models\ItemPrice;
use App\Models\Payment;
use App\Models\TransactionType;

function isAdmin()
{
    return true;
}