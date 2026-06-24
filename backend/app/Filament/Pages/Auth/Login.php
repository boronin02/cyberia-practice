<?php

namespace App\Filament\Pages\Auth;

use Database\Factories\UserFactory;
use Filament\Facades\Filament;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

final class Login extends BaseLogin
{
    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $data = App::isLocal()
            ? [
                'email' => UserFactory::DEFAULT_EMAIL,
                'password' => UserFactory::DEFAULT_PASSWORD,
            ]
            : [];

        $this->form->fill($data);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email' => Str::lower(Arr::string($data, 'email')),
            'password' => Arr::string($data, 'password'),
        ];
    }
}
