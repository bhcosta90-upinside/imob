<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Http\Controllers\Controller;
use App\Property;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() === true) {
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        $lessors = User::lessors()->count();
        $lesseess = User::lesseess()->count();
        $team = User::team()->count();
        $property = Property::count();
        $propertyAvailable = Property::available()->count();
        $propertyUnvailable = Property::unavailable()->count();
        $contract = Contract::count();
        $contractPending = Contract::pending()->count();
        $contractActive = Contract::active()->count();
        $contractCanceled = Contract::canceled()->count();

        $contracts = Contract::with(['owner', 'acquirer'])->orderBy('id', 'DESC')->limit(10)->get();
        $properties = Property::orderBy('id', 'DESC')->limit(3)->get();

        return view('admin.dashboard', compact(
            'lessors', 
            'lesseess', 
            'team', 
            'property', 
            'propertyAvailable', 
            'propertyUnvailable',
            'contract',
            'contractPending',
            'contractActive',
            'contractCanceled',
            'contracts',
            'properties'
        ));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.index');
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only(['email', 'password']))) {
            return response()
                ->json([
                    "msg" => $this->message
                        ->error(__("Ooops, informe todos os dados para efetual o login"))
                        ->render()
                ]);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()
                ->json([
                    "msg" => $this->message
                        ->error(__("Ooops, informe um e-mail válido"))
                        ->render()
                ]);
        }

        $credential = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        if (!Auth::attempt($credential)) {
            return response()
                ->json([
                    "msg" => $this->message
                        ->error(__("Ooops, usuário e senha não existe em nossa base de dados"))
                        ->render()
                ]);
        }

        $this->authenticated($request->ip());

        return response()
            ->json([
                "redirect" => route('admin.home')
            ]);
    }

    private function authenticated(string $ip)
    {
        Auth::user()->update([
            "last_login_at" => Carbon::now(),
            "last_login_ip" => $ip,
        ]);
    }
}
