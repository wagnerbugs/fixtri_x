<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    #[Validate('required', message: 'O nome é obrigatório')]
    #[Validate('max:255', message: 'O nome deve ter no máximo 255 caracteres')]
    #[Validate('min:3', message: 'O nome deve ter no mínimo 3 caracteres')]
    public string $name = '';

    #[Validate('required', message: 'O e-mail é obrigatório')]
    #[Validate('email', message: 'O email informado é inválido')]
    public string $email = '';

    #[Validate('required', message: 'A senha é obrigatória')]
    #[Validate('min:8', message: 'A senha deve ter no mínimo 8 caracteres')]
    public string $password = '';

    #[Validate('required', message: 'A senha é obrigatória')]
    #[Validate('min:8', message: 'A senha deve ter no mínimo 8 caracteres')]
    #[Validate('same:password', message: 'As senhas não conferem')]
    public string $password_confirmation = '';

    #[Validate('boolean')]
    public bool $terms = false;

    public function register()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('index', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
