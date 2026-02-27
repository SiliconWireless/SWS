<?php

namespace App\Reports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssetsExport implements FromCollection
{
    public function __construct(private readonly int $organizationId)
    {
    }

    public function collection()
    {
        return Asset::where('organization_id', $this->organizationId)
            ->get(['asset_code', 'name', 'category', 'ble_mac', 'status', 'last_seen_at']);
    }
}
