<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Intervention\Image\ImageManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Drivers\Gd\Driver;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Toko Saya';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Detail Produk')
                    ->description('Informasi dasar produk Anda')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Sepatu Nike Air Max')
                            ->columnSpanFull(),

                        TextInput::make('price')
                            ->label('Harga Produk')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->placeholder('100000')
                            ->helperText('Masukkan harga tanpa titik atau koma'),

                        Select::make('categories')
                            ->label('Kategori Produk')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->placeholder('Pilih satu atau lebih kategori')
                            ->helperText('Anda dapat memilih lebih dari satu kategori')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Kategori')
                                    ->required(),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Media & Deskripsi')
                    ->description('Upload gambar dan tulis deskripsi produk')
                    ->schema([
                        FileUpload::make('url_media')
                            ->label('Logo Media')
                            ->directory(function (callable $get) {
                                $title = $get('title');
                                if (empty($title)) {
                                    return 'store/default-slug';
                                }
                                $slug = Str::slug($title);
                                return "product/{$slug}";
                            })
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->minSize(128)
                            ->maxSize(4096)
                            ->downloadable()
                            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, Get $get) {
                                $manager = new ImageManager(new Driver());

                                $filePath = $file->getRealPath();
                                $image = $manager->read($filePath);

                                $targetSize = 500;

                                if ($image->width() > $targetSize || $image->height() > $targetSize) {
                                    $image->scaleDown($targetSize);
                                }

                                $image->sharpen(8);

                                $encoded = $image->encodeByExtension('jpg');

                                $title = $get('title') ?? 'default-logo';

                                $slug = Str::slug($title);
                                $fileName = "{$slug}.jpg";

                                $directory = "product/{$slug}";
                                $path = "{$directory}/{$fileName}";

                                Storage::disk('public')->put($path, (string) $encoded, 'public');

                                return $path;
                            }),
                        RichEditor::make('description')
                            ->label('Deskripsi Produk')
                            ->maxLength(1000)
                            ->disableToolbarButtons([
                                'attachFiles',
                            ])
                            ->placeholder('Jelaskan detail produk Anda...')
                            ->helperText('Maksimal 1000 karakter')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                ImageColumn::make('url_media')
                    ->label('Gambar')
                    ->circular()
                    ->size(40)
                    ->url(fn($record) => '/storage/' . $record->url_media),

                TextColumn::make('title')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) > 50) {
                            return $state;
                        }
                        return null;
                    }),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->weight('semibold')
                    ->color('success'),

                TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->toggleable()
                    ->wrap(),

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
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable()
                    ->color('gray'),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since()
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('categories')
                    ->label('Filter Kategori')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('Semua Kategori'),

                Filter::make('price_range')
                    ->form([
                        TextInput::make('price_from')
                            ->label('Harga Minimum')
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('price_to')
                            ->label('Harga Maksimum')
                            ->numeric()
                            ->prefix('Rp'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn(Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_to'],
                                fn(Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['price_from'] ?? null) {
                            $indicators[] = 'Harga dari: Rp ' . number_format($data['price_from'], 0, ',', '.');
                        }
                        if ($data['price_to'] ?? null) {
                            $indicators[] = 'Harga sampai: Rp ' . number_format($data['price_to'], 0, ',', '.');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Lihat')
                        ->icon('heroicon-o-eye'),

                    EditAction::make()
                        ->label('Edit')
                        ->icon('heroicon-o-pencil'),

                    DeleteAction::make()
                        ->label('Hapus')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->tooltip('Aksi'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus yang dipilih')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('updateStatus')
                        ->label('Update Status')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistColumnSearchesInSession()
            ->striped()
            ->emptyStateHeading('Belum ada produk')
            ->emptyStateDescription('Klik tombol "Buat Produk Baru" untuk menambahkan produk pertama Anda.')
            ->emptyStateIcon('heroicon-o-shopping-bag');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['store', 'categories']);
    }
}
