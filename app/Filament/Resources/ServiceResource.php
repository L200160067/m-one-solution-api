<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Layanan')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori Layanan')
                    ->maxLength(100),

                Forms\Components\TextInput::make('order_column')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
            ])->columns(2),

            Forms\Components\Section::make('Deskripsi')->schema([
                Forms\Components\Textarea::make('short_description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('full_description')
                    ->label('Deskripsi Lengkap')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Detail Layanan')->schema([
                Forms\Components\TagsInput::make('features')
                    ->label('Fitur-fitur (tekan Enter untuk menambah)')
                    ->columnSpanFull(),

                Forms\Components\TagsInput::make('benefits')
                    ->label('Manfaat / Benefits')
                    ->columnSpanFull(),

                Forms\Components\TagsInput::make('keywords')
                    ->label('Kata Kunci SEO')
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Gambar')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Gambar Layanan')
                    ->collection('image')
                    ->image()
                    ->imageEditor()
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('')
                    ->collection('image')
                    ->width(50)->height(40),

                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('order_column')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
