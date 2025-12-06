<?php

namespace App\Filament\Admin\Resources\StoreResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('User')
                            ->relationship('users', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pivot Data')
                    ->schema([
                        Forms\Components\Toggle::make('is_owner')
                            ->label('Is Owner')
                            ->helperText('Mark this user as the store owner')
                            ->default(false),
                    ])
                    ->columns(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('User Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-envelope'),

                Tables\Columns\IconColumn::make('is_owner')
                    ->label('Owner')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color('primary')
                    ->separator(',')
                    ->wrap(),

                Tables\Columns\TextColumn::make('permissions.name')
                    ->label('Permissions')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->limit(3)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return is_array($state) && count($state) > 3
                            ? implode(', ', $state)
                            : null;
                    }),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_owner')
                    ->label('Owner Status')
                    ->placeholder('All users')
                    ->trueLabel('Owners only')
                    ->falseLabel('Non-owners only'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Toggle::make('is_owner')
                            ->label('Is Owner')
                            ->helperText('Mark this user as the store owner')
                            ->default(false),
                        Forms\Components\Section::make('Assign Roles & Permissions')
                            ->schema([

                                Forms\Components\Select::make('roles')
                                    ->label('Roles')
                                    ->multiple()
                                    ->relationship(
                                        'roles',
                                        'name',
                                        fn (Builder $query) => $query
                                            ->where('roles.guard_name', 'web')
                                            ->where('roles.store_id', $this->getOwnerRecord()->id)
                                    )
                                    ->preload()
                                    ->searchable()
                                    ->helperText('Assign roles to this user for the store'),

                            ])
                            ->columns(1),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Toggle::make('is_owner')
                            ->label('Is Owner')
                            ->helperText('Mark this user as the store owner')
                            ->default(false),
                        Forms\Components\Section::make('Manage Roles & Permissions')
                            ->schema([
                                Forms\Components\Select::make('roles')
                                    ->label('Roles')
                                    ->multiple()
                                    ->relationship(
                                        'roles',
                                        'name',
                                        fn (Builder $query) => $query
                                            ->where('roles.guard_name', 'web')
                                            ->where('roles.store_id', $this->getOwnerRecord()->id)
                                    )
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\Select::make('permissions')
                                    ->label('Direct Permissions')
                                    ->multiple()
                                    ->relationship('permissions', 'name')
                                    ->preload()
                                    ->searchable(),
                            ])
                            ->columns(1),
                    ]),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
