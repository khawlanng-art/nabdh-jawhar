<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->get('q');


        $users = User::where('Username', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get(['UserID', 'Username', 'Role']);

    
        $services = Service::where('ServiceName', 'LIKE', "%{$query}%")
                        ->get(['ServiceID', 'ServiceName']);

        return response()->json([
            'users' => $users,
            'services' => $services
        ]);
    }
}
