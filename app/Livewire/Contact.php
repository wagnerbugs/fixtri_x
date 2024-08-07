<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Contact as ContactModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Contact extends Component
{
    use LivewireAlert;

    #[Validate('required', message: 'O nome é obrigatório')]
    #[Validate('min:3', message: 'O nome deve ter no mínimo 3 caracteres')]
    public string $name = '';

    #[Validate('email', message: 'Informe um email válido')]
    #[Validate('nullable')]
    public string $email = '';

    #[Validate('nullable')]
    public string $phone = '';

    #[Validate('required', message: 'A mensagem é obrigatória')]
    #[Validate('min:3', message: 'A mensagem deve ter no mínimo 3 caracteres')]
    public string $message = '';

    public function submit()
    {
        $this->validate();

        ContactModel::create(
            $this->only(['name', 'email', 'phone', 'message'])
        );

        $this->alert('success', 'Mensagem enviada com sucesso!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
