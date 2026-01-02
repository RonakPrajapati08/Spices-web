<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    // public bool $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (
            Auth::guard('admin')->attempt(
                [
                    'email' => $this->email,
                    'password' => $this->password,
                    'is_active' => 1,
                ],
            )
        ) {
            request()->session()->regenerate();
            // redirect using Livewire helper (don't return it)
            session()->flash('message', 'Login successful. you will be accessed to dashboard .');
            $this->redirectRoute('admin.dashboard');
            return;
        }

        $this->addError('email', 'Invalid credentials or account disabled.');
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
