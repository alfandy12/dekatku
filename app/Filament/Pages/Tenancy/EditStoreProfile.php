<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Form;
use App\Trait\Store\FieldRegistration;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditStoreProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Store Profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                FieldRegistration::formFields()
            );
    }
}
