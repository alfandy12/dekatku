<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\Action as ActionTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Member extends Page implements HasForms, HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.tenancy.member';

    protected static bool $shouldRegisterNavigation = false;

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereHas('stores', function ($query) {
                $query->where('stores.id', Filament::getTenant()->id);
            }))
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->iconColor('primary')
                    ->iconPosition(IconPosition::After)
                    ->icon(fn(User $record) => $record->stores()->wherePivot('is_owner', 1)->where('id', Filament::getTenant()->id)->exists() ? 'heroicon-m-star' : null),

                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Bergabung Sejak')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    ActionTable::make('kick')
                        ->icon('heroicon-m-user-minus')
                        ->label('Keluarkan Member')
                        ->action(function (User $record): void {
                            $record->stores()->detach(Filament::getTenant()->id);
                        })
                        ->hidden(function (User $record) {
                            $tenantId = Filament::getTenant()->id;
                            $currentUser = Auth::user();

                            // Cek apakah current user adalah owner
                            $currentUserIsOwner = $currentUser
                                ->stores()
                                ->wherePivot('is_owner', 1)
                                ->where('id', $tenantId)
                                ->exists();

                            // Jika current user bukan owner -> sembunyikan
                            if (! $currentUserIsOwner) {
                                return true;
                            }

                            // Cek apakah target user (record) adalah owner
                            $targetIsOwner = $record
                                ->stores()
                                ->wherePivot('is_owner', 1)
                                ->where('id', $tenantId)
                                ->exists();

                            // Jika target adalah owner -> sembunyikan
                            if ($targetIsOwner) {
                                return true;
                            }

                            return false;
                        })
                        ->requiresConfirmation()
                        ->color('danger')
                ]),
            ])
            ->bulkActions([]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label('Tambah Member')
                ->form([
                    Select::make('userId')
                        ->label('Pilih User')
                        ->getSearchResultsUsing(fn(string $search): array => User::where('email', 'like', "%{$search}%")->limit(50)->pluck('email', 'id')->toArray())
                        ->getOptionLabelUsing(fn($value): ?string => User::find($value)?->email)
                        ->searchable()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->unique(table: 'users', column: 'email'),
                            TextInput::make('password')
                                ->label('Password')
                                ->password()
                                ->required()
                                ->minLength(8),
                        ])
                        ->createOptionUsing(function (array $data) {
                            return User::create([
                                'name' => $data['name'],
                                'email' => $data['email'],
                                'password' => Hash::make($data['password']),
                            ])->id;
                        })
                        ->required()
                        ->helperText('Cari email user yang sudah terdaftar, atau klik tombol plus (+) untuk mendaftarkan user baru.'),
                ])
                ->action(function (array $data): void {
                    $tenantId = Filament::getTenant()->id;
                    $userId = $data['userId'];

                    $user = User::find($userId);

                    $exists = $user->stores()->where('stores.id', $tenantId)->exists();

                    if ($exists) {
                        Notification::make()
                            ->title('Gagal')
                            ->body('User ini sudah menjadi member di toko Anda.')
                            ->danger()
                            ->send();
                        return;
                    }

                    $user->stores()->attach($tenantId, ['is_owner' => false]);

                    Notification::make()
                        ->title('Sukses')
                        ->body('Member berhasil ditambahkan!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
