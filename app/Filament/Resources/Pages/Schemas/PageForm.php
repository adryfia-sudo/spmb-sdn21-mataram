<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set) {
                        if (blank($state)) {
                            return;
                        }

                        $set(
                            'slug',
                            \Illuminate\Support\Str::slug($state)
                        );
                    }),

                TextInput::make('slug')
                    ->label('Slug / URL')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Contoh: sejarah, visi-misi, profil-sekolah'),

                RichEditor::make('content')
                    ->label('Isi Halaman')
                    ->required()
                    ->columnSpanFull()
		    ->fileAttachmentsDisk('public')
		    ->fileAttachmentsDirectory('pages/content')
		    ->fileAttachmentsVisibility('public')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
			'attachFiles',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                        'codeBlock',
                        'undo',
                        'redo',
                    ]),

                FileUpload::make('featured_image')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->directory('pages')
                    ->imageEditor()
                    ->nullable(),

                Toggle::make('is_published')
                    ->label('Publikasikan')
                    ->default(false)
                    ->live(),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->default(now())
                    ->nullable()
                    ->visible(fn ($get) => $get('is_published')),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
            ]);
    }
}
