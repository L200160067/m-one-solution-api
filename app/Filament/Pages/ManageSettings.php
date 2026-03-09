<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $title = 'Pengaturan Website';
    protected static ?int $navigationSort = 10;
    protected static string $view = 'filament.pages.manage-settings';

    // Form field bindings
    public ?string $company_name       = null;
    public ?string $company_address    = null;
    public ?string $contact_email      = null;
    public ?string $contact_phone      = null;
    public ?string $whatsapp_number    = null;
    public ?string $facebook_url       = null;
    public ?string $instagram_url      = null;
    public ?string $tiktok_url         = null;
    public ?string $youtube_url        = null;
    public ?string $linkedin_url       = null;

    public function mount(): void
    {
        $settings = Setting::allAsArray();

        $this->fill([
            'company_name'    => $settings['company_name'] ?? null,
            'company_address' => $settings['company_address'] ?? null,
            'contact_email'   => $settings['contact_email'] ?? null,
            'contact_phone'   => $settings['contact_phone'] ?? null,
            'whatsapp_number' => $settings['whatsapp_number'] ?? null,
            'facebook_url'    => $settings['facebook_url'] ?? null,
            'instagram_url'   => $settings['instagram_url'] ?? null,
            'tiktok_url'      => $settings['tiktok_url'] ?? null,
            'youtube_url'     => $settings['youtube_url'] ?? null,
            'linkedin_url'    => $settings['linkedin_url'] ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Perusahaan')->schema([
                TextInput::make('company_name')
                    ->label('Nama Perusahaan')
                    ->required(),

                Textarea::make('company_address')
                    ->label('Alamat Kantor')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('contact_email')
                    ->label('Email Kontak')
                    ->email(),

                TextInput::make('contact_phone')
                    ->label('Telepon')
                    ->tel(),

                TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->helperText('Format: 628xxxxxxxxxx'),
            ])->columns(2),

            Section::make('Sosial Media')->schema([
                TextInput::make('facebook_url')
                    ->label('Facebook URL')
                    ->url()->prefix('https://'),

                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->url()->prefix('https://'),

                TextInput::make('tiktok_url')
                    ->label('TikTok URL')
                    ->url()->prefix('https://'),

                TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->url()->prefix('https://'),

                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url()->prefix('https://'),
            ])->columns(2),
        ])->statePath(null);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        // Clear settings cache on save
        Cache::forget('settings.all');

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->action('save'),
        ];
    }
}
