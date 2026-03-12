<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pemberi Testimoni')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')->required(),

                Forms\Components\TextInput::make('role')
                    ->label('Jabatan'),

                Forms\Components\TextInput::make('company')
                    ->label('Perusahaan / Instansi'),

                Forms\Components\Select::make('rating')
                    ->label('Rating')
                    ->options([1 => '⭐ 1', 2 => '⭐⭐ 2', 3 => '⭐⭐⭐ 3', 4 => '⭐⭐⭐⭐ 4', 5 => '⭐⭐⭐⭐⭐ 5'])
                    ->default(5)
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Tampilkan di Website?')
                    ->default(true),
            ])->columns(2),

            Forms\Components\Section::make('Isi Testimoni')->schema([
                Forms\Components\Textarea::make('content')
                    ->label('Testimoni')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Foto')->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Foto Profil')
                    ->collection('avatar')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label('')
                    ->collection('avatar')
                    ->circular()
                    ->width(36)->height(36),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()->sortable(),

                Tables\Columns\TextColumn::make('company')
                    ->label('Perusahaan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state)),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
            ])
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
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
