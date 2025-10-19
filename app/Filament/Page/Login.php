<?php

namespace App\Filament\Page;

use Filament\Auth\Pages\Login as LoginBase;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use SensitiveParameter;

class Login extends LoginBase
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getMobileFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('mobile')
            ->label('Mobile')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        return [
            'phone' => $data['mobile'],
            'password' => $data['password'],
        ];
    }
}
