<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // create file if not exits in root directory named gpt-response.txt
        $file = storage_path('./gpt-response.txt');
        if (!file_exists($file)) {
            file_put_contents($file, '');
        }
        $data['gpt_response'] = file_get_contents($file);

        return view('dashboard', $data);
    }
}
