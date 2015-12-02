<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Import;
use Auth;

class ImportController extends Controller
{
    public function __construct() {
        $this->import = new Import();
        $this->user = Auth::user();
    }

    public function import()
    {
        if ($this->user->can('import', $this->import)) {
            $this->import->import();
        }
        else {
            abort(403);
        }
    }
}
