<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ForbiddenController extends Controller
{
    public function index(){

        $loggedCodigo = intval(Auth::id());

        $User = User::where('Usu_Codigo', $loggedCodigo)->first();

        return view('forbidden.index', ['User' => $User]);

    }
}
