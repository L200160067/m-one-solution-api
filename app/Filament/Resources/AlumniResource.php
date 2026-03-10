<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Alumni PKL';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Siswa')
                ->required(),

            Forms\Components\TextInput::make('school')
                ->label('Asal Sekolah / Kampus')
                ->required(),

            Forms\Components\TextInput::make('batch_period')
                ->label('Batch / Periode (contoh: Batch 2024)')
                ->required(),

            Forms\Components\TextInput::make('order_column')
                ->label('Urutan')
                ->numeric()
                ->default(0),

            SpatieMediaLibraryFileUpload::make('photo')
                ->label('Foto')
                ->collection('photo')
                ->image()
                ->imageEditor()
                ->optimize('webp')
                ->maxSize(2048)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photo')
                    ->label('')
                    ->collection('photo')
                    ->circular()
                    ->width(36)->height(36),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()->sortable(),

                Tables\Columns\TextColumn::make('school')
                    ->label('Sekolah')
                    ->searchable(),

                Tables\Columns\TextColumn::make('batch_period')
                    ->label('Batch')
                    ->badge()
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('batch_period', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('batch_period')
                    ->label('Filter Batch')
                    ->options(fn () => Alumni::distinct()->pluck('batch_period', 'batch_period')->toArray()),
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
            'index'  => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit'   => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
