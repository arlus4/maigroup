<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Check_Connection extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName()) {
                return "Successfully connected to the database: " . DB::connection()->getDatabaseName();
            }
        } catch (\Exception $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    public function checkPhp()
    {
        phpinfo();
    }
}
