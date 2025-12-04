<?php

namespace App\Trait\Store;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Afsakar\LeafletMapPicker\LeafletMapPicker;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Grid;

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
                ->required()
                ->label('Type')
                ->options([
                    'service' => 'Service',
                    'product' => 'Product',
                ])
                ->default('product'),

            LeafletMapPicker::make('location')
                ->label('Select Location')
                ->helperText('Pick the location of your store on the map.')
                ->defaultZoom(13),

            FileUpload::make('url_media')
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
                ->label('Description')
                ->maxLength(1000)
                ->disableToolbarButtons([
                    'attachFiles',
                ])
                ->nullable(),
        ];
    }
}
