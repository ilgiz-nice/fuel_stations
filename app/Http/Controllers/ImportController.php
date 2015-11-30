<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Import;

class ImportController extends Controller
{
    public function __construct() {
        $this->import = new Import();
    }

    public function import()
    {
        $this->import->import();
    }
}
