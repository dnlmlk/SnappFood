<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use phpDocumentor\Reflection\Types\Collection;

class ReportExport implements FromCollection
{
    public $totalIncome;
    public $totalSales;
    public $filter;

    public function __construct($data)
    {
        $this->totalIncome = $data['totalIncome'];
        $this->totalSales = $data['totalSales'];
        $this->filter = $data['filter'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new \Illuminate\Database\Eloquent\Collection([
            ["Finance report of restaurant at", $this->filter],
            ['Total Income', $this->totalIncome . '$'],
            ['Total Sales' , $this->totalSales],
        ]);
    }
}
