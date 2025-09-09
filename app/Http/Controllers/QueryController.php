<?php

namespace App\Http\Controllers;
use App\Models\DocumentRepository;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function landing_page() {
        return view('guest.main');
    }

       public function login_page() {
        return view('auth.login');
    }
       public function recovery_page() {
        return view('auth.recovery');
    }

}
