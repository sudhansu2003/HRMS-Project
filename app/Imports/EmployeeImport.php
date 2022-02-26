<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class EmployeeImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        //
    }
}
