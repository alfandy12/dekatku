<?php

namespace App\Trait\Store\Product;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Get;
use Filament\Facades\Filament;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ProductTrait
{
    public static function getProductFormSchema(): array
    {
        return [
            Section::make('Detail Produk')
                ->description('Informasi dasar produk Anda')
                ->schema([
                    TextInput::make('title')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Sep-atu Nike Air Max')
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
                        ->directory(function (Get $get) {
                            $title = $get('title');
                            // Fallback jika title belum diisi saat upload
                            if (empty($title)) {
                                return 'store/temp';
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

                            // Resize jika gambar terlalu besar
                            if ($image->width() > $targetSize || $image->height() > $targetSize) {
                                $image->scaleDown($targetSize);
                            }

                            // Pertajam sedikit agar hasil resize tetap tajam
                            $image->sharpen(8);

                            // Encode ke JPG
                            $encoded = $image->encodeByExtension('jpg');

                            // Generate nama file
                            $title = $get('title') ?? 'default-product';
                            $slug = Str::slug($title);

                            // Mendapatkan nama tenant/toko saat ini
                            // Pastikan model tenant Anda memiliki kolom 'title' atau 'slug'
                            $store = Filament::getTenant()->title ?? 'general';
                            $storeSlug = Str::slug($store);

                            // Menggunakan timestamp untuk menghindari cache browser jika gambar diupdate
                            $fileName = "{$slug}-" . time() . ".jpg";

                            $directory = "store/{$storeSlug}/products";
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
        ];
    }
}
