<?php

namespace App\Http\Controllers\Vuln;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VulnRceController extends Controller
{
      public function form()
    {
        $user=User::all();
        return view('vuln.rce_form',compact('user'));
    }

    public function execute(Request $request)
    {
        $cmd = $request->input('cmd');
        $output = shell_exec($cmd);
        return view('vuln.rce_form', ['result' => $output]);
    }
}

