<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Admin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

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
                Components\Section::make('Product Overview')
                    ->schema([
                        Components\ImageEntry::make('url_media')
                            ->label('Product Image')
                            ->defaultImageUrl(url('/images/placeholder-product.png'))
                            ->columnSpanFull()
                            ->height(300),

                        Components\TextEntry::make('title')
                            ->label('Product Name')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->columnSpanFull(),

                        Components\TextEntry::make('store.title')
                            ->label('Store')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-building-storefront'),

                        Components\TextEntry::make('price')
                            ->label('Price')
                            ->money('IDR')
                            ->size(Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->color('primary'),

                        Components\TextEntry::make('categories.name')
                            ->label('Categories')
                            ->badge()
                            ->color('info')
                            ->separator(',')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Components\Section::make('Description')
                    ->schema([
                        Components\TextEntry::make('description')
                            ->label('')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Components\Section::make('Metadata')
                    ->schema([
                        Components\TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->icon('heroicon-o-calendar'),

                        Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime()
                            ->icon('heroicon-o-clock'),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }
}
