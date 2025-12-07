<?php

namespace App\Filament\Admin\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $title = 'Products';

    protected static ?string $icon = 'heroicon-o-shopping-bag';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\ImageColumn::make('url_media')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder-product.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->wrap(),

                Tables\Columns\TextColumn::make('store.title')
                    ->label('Store')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-building-storefront'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable()
                    ->weight(FontWeight::SemiBold)
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('store')
                    ->relationship('store', 'title')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->label('Filter by Store'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Attach Product'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No products in this category')
            ->emptyStateDescription('Attach existing products to this category.')
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateActions([
                Tables\Actions\AttachAction::make()
                    ->label('Attach Product')
                    ->icon('heroicon-o-paper-clip'),
            ]);
    }
}
