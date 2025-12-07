<?php

namespace App\Filament\Admin\Resources\CategoryResource\Pages;

use App\Filament\Admin\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Category Overview')
                    ->schema([
                        Components\TextEntry::make('name')
                            ->label('Category Name')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->columnSpanFull(),

                        Components\TextEntry::make('slug')
                            ->label('Slug')
                            ->copyable()
                            ->icon('heroicon-o-link')
                            ->columnSpanFull(),

                        Components\TextEntry::make('products_count')
                            ->label('Total Products')
                            ->state(fn ($record) => $record->products()->count())
                            ->badge()
                            ->color(function ($state): string {
                                return match (true) {
                                    $state === 0 => 'gray',
                                    $state < 5 => 'warning',
                                    $state < 20 => 'success',
                                    default => 'primary',
                                };
                            })
                            ->icon('heroicon-o-shopping-bag'),

                        Components\TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->icon('heroicon-o-calendar'),

                        Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime()
                            ->icon('heroicon-o-clock'),
                    ])
                    ->columns(2),
            ]);
    }
}
