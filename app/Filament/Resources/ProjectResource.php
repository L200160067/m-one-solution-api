<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Portofolio';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Proyek')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Proyek')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(100),

                Forms\Components\TextInput::make('client_name')
                    ->label('Nama Klien'),

                Forms\Components\TextInput::make('project_url')
                    ->label('URL Proyek')
                    ->url()
                    ->prefix('https://'),

                Forms\Components\TextInput::make('order_column')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Tampilkan di Halaman Utama?')
                    ->default(false),
            ])->columns(2),

            Forms\Components\Section::make('Deskripsi')->schema([
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Proyek')
                    ->rows(4)
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Gambar Proyek')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Gambar')
                    ->collection('image')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->maxSize(8192)
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
                    ->width(60)->height(40),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Proyek')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),

                Tables\Columns\TextColumn::make('client_name')
                    ->label('Klien')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order_column')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')->label('Hanya Featured'),
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
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
