<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Tim';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Anggota')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),

                Forms\Components\TextInput::make('role')
                    ->label('Jabatan / Peran')
                    ->required(),

                Forms\Components\TextInput::make('order_column')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
            ])->columns(3),

            Forms\Components\Section::make('Sosial Media')->schema([
                Forms\Components\TextInput::make('social_linkedin')
                    ->label('LinkedIn URL')
                    ->url()->prefix('https://'),

                Forms\Components\TextInput::make('social_github')
                    ->label('GitHub URL')
                    ->url()->prefix('https://'),

                Forms\Components\TextInput::make('social_instagram')
                    ->label('Instagram URL')
                    ->url()->prefix('https://'),
            ])->columns(3),

            Forms\Components\Section::make('Foto')->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Foto Profil')
                    ->collection('avatar')
                    ->image()
                    ->imageEditor()
                    ->maxSize(3072)
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
                    ->width(40)->height(40),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan')
                    ->badge(),

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
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
