<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Store;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Trait\StoreTrait;
use Filament\Support\Enums\MaxWidth;
use App\Trait\Store\FieldRegistration;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterStore extends RegisterTenant
{
    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public static function getLabel(): string
    {
        return 'Register Store';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                FieldRegistration::formFields()
            );
    }

    protected function handleRegistration(array $data): Store
    {
        $store = Store::create($data);

        $store->users()->attach(auth()->user());

        return $store;
    }

}

