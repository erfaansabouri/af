<?php

namespace App\Exports;

use App\Models\DailyLog;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PropertyExport implements FromView {
    public $properties;

    public function __construct ( $properties ) {
        $this->properties = $properties;
    }

    public function view (): View {
        return view('exports.properties' , [
            'properties' => $this->properties ,
        ]);
    }
}
