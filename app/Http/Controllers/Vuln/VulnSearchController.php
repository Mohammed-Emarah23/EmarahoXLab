<?php

namespace App\Http\Controllers\Vuln;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VulnSearchController extends Controller
{
    public function search(Request $request)
{
    $referer = $request->header('referer');
    $xForwardedFor = $request->header('X-Forwarded-For');
    $error = null;
    $results = [];

    try {
        if ($referer) {
            $query = "SELECT * FROM products WHERE name LIKE '%$referer%'";
            $results = DB::select($query);
        }
    } catch (\Exception $e) {
        $error = $e->getMessage();
    }

    return view('vuln.sqli_results_referer', compact('referer', 'xForwardedFor', 'results', 'error'));
}

       public function vulnerableSearch(Request $request)
                {
                    $keyword = $request->query('keyword', '');
                    $products = [];
                    $error = null;

                    try {
                        if ($keyword) {
                            $fakeQuery = "SELECT * FROM products WHERE name LIKE '%$keyword%'"; // مجرد شكل
                            $products = DB::table('products')
                                ->where('name', 'LIKE', '%' . $keyword . '%')
                                ->get();
                        } else {
                            $products = Product::take(5)->get();
                        }
                    } catch (\Exception $e) {
                        $error = "SQLSTATE[42000]: Syntax error or access violation: simulated error"; // تمويه برسالة كأن فيه SQL error
                    }

                    return view('Client.home', compact('products', 'keyword', 'error'));
                }


}
