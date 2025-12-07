<?php

namespace App\Trait\Store;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Intervention\Image\ImageManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Intervention\Image\Drivers\Gd\Driver;
use Afsakar\LeafletMapPicker\LeafletMapPicker;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait FieldRegistration
{
    public static function formFields(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->label('Name')
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->label('Slug')
                        ->maxLength(255)
                        ->helperText('A unique identifier for your store, used in URLs.')
                        ->unique(table: 'stores', ignorable: fn($record) => $record),
                ]),

            Select::make('type')
                ->columnSpanFull()
                ->required()
                ->label('Type')
                ->options([
                    'service' => 'Service',
                    'product' => 'Product',
                ])
                ->default('product'),

            LeafletMapPicker::make('location')
                ->columnSpanFull()
                ->label('Select Location')
                ->helperText('Pick the location of your store on the map.')
                ->defaultZoom(13),

            FileUpload::make('url_media')
                ->columnSpanFull()
                ->label('Logo Media')
                ->directory(function (callable $get) {
                    $title = $get('title');
                    if (empty($title)) {
                        return 'store/default-slug';
                    }
                    $slug = Str::slug($title);
                    return "store/{$slug}";
                })
                ->visibility('public')
                ->image()
                ->imageEditor()
                ->minSize(128)
                ->maxSize(4096)
                ->downloadable()
                ->required()
                ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, $component) {
                    $manager = new ImageManager(new Driver());

                    $filePath = $file->getRealPath();
                    $image = $manager->read($filePath);

                    $targetSize = 500;

                    if ($image->width() > $targetSize || $image->height() > $targetSize) {
                        $image->scaleDown($targetSize);
                    }

                    $image->sharpen(8);

                    $encoded = $image->encodeByExtension('png');
                    $fileName = "logo.png";
                    $directory = $component->getDirectory();
                    $path = "{$directory}/{$fileName}";
                    Storage::disk('public')->put($path, (string) $encoded, 'public');

                    return $path;
                }),

            RichEditor::make('description')
                ->columnSpanFull()
                ->label('Description')
                ->maxLength(1000)
                ->disableToolbarButtons([
                    'attachFiles',
                ]),

            Section::make('Kontak & Media Sosial')
                ->description('Tambahkan kontak dan link media sosial toko.')
                ->schema([

                    // 1. REPEATER KONTAK
                    Repeater::make('contacts')
                        ->relationship()
                        ->label('Daftar Kontak')
                        ->schema([
                            Select::make('type')
                                ->label('Tipe')
                                ->options([
                                    'whatsapp' => 'WhatsApp',
                                    'email' => 'Email',
                                    'phone' => 'Telepon Kantor',
                                ])
                                ->required()
                                ->columnSpan(1),

                            TextInput::make('value')
                                ->label('Nomor / Email')
                                ->required()
                                ->columnSpan(2)
                                ->placeholder('Contoh: 08123456789 atau toko@email.com'),
                        ])
                        ->columns(3)
                        ->defaultItems(1)
                        ->addActionLabel('Tambah Contact'),

                    Repeater::make('socials')
                        ->relationship()
                        ->label('Media Sosial')
                        ->schema([
                            Select::make('platform')
                                ->options([
                                    'instagram' => 'Instagram',
                                    'facebook' => 'Facebook',
                                    'tiktok' => 'TikTok',
                                    'twitter' => 'Twitter (X)',
                                    'website' => 'Website',
                                ])
                                ->columnSpan(1),

                            TextInput::make('url')
                                ->label('Link URL')
                                ->url()
                                ->columnSpan(2)
                                ->placeholder('https://instagram.com/namatoko'),
                        ])
                        ->columns(3)
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Sosmed'),
                ])
                ->collapsible(),
        ];
    }
}
