<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentProducts extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('store_id', Filament::getTenant()->id)
                    ->with(['categories'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                ImageColumn::make('url_media')
                    ->url(fn($record) => asset('storage/' . $record->url_media))
                    ->defaultImageUrl(url('/images/placeholder.png')),

                TextColumn::make('title')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->limit(20),

                TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->separator(',')
                    ->limitList(1),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->html()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen(strip_tags($state)) > 50) {
                            return strip_tags($state);
                        }
                        return null;
                    }),
            ])
            ->heading('Produk Terbaru')
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }
}
