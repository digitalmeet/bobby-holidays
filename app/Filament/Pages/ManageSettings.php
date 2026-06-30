<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected string $view = 'filament.pages.manage-settings';

    protected static ?string $title = 'Site Settings';

    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')->tabs([
                    Tab::make('Company')->icon('heroicon-o-building-office')->columns(2)->schema([
                        TextInput::make('company_name')->label('Company Name')->default('UniWorld Holidays'),
                        TextInput::make('company_tagline')->label('Tagline'),
                        TextInput::make('company_phone')->label('Phone')->tel(),
                        TextInput::make('company_whatsapp')->label('WhatsApp Number'),
                        TextInput::make('company_email')->label('Email')->email(),
                        TextInput::make('company_address')->label('Address'),
                        TextInput::make('company_city')->label('City'),
                        TextInput::make('company_gst')->label('GST Number'),
                    ]),
                    Tab::make('Social')->icon('heroicon-o-globe-alt')->columns(2)->schema([
                        TextInput::make('social_facebook')->label('Facebook URL')->url(),
                        TextInput::make('social_instagram')->label('Instagram URL')->url(),
                        TextInput::make('social_youtube')->label('YouTube URL')->url(),
                        TextInput::make('social_linkedin')->label('LinkedIn URL')->url(),
                        TextInput::make('social_twitter')->label('Twitter/X URL')->url(),
                        TextInput::make('social_google_maps')->label('Google Maps URL')->url(),
                    ]),
                    Tab::make('Quotation Defaults')->icon('heroicon-o-document-text')->schema([
                        Textarea::make('quotation_default_terms')->label('Default Terms & Conditions')->rows(8)
                            ->helperText('Pre-filled when creating new quotations.'),
                        Textarea::make('quotation_default_message')->label('Default Personalised Message')->rows(4),
                        TextInput::make('quotation_validity_days')->label('Default Validity (days)')->numeric()->default(7),
                    ]),
                    Tab::make('SEO')->icon('heroicon-o-magnifying-glass')->columns(2)->schema([
                        TextInput::make('seo_title')->label('Default Page Title'),
                        TextInput::make('seo_description')->label('Default Meta Description'),
                        TextInput::make('seo_keywords')->label('Keywords'),
                        TextInput::make('google_analytics_id')->label('Google Analytics ID')->placeholder('G-XXXXXXXXXX'),
                    ]),
                    Tab::make('Payment Gateway')->icon('heroicon-o-credit-card')->columns(2)->schema([
                        Select::make('razorpay_enabled')->label('Enable Razorpay')
                            ->options(['false' => 'Disabled', 'true' => 'Enabled'])
                            ->default('false')
                            ->helperText('Enable online payments on public quotation pages.'),
                        TextInput::make('razorpay_mode')->label('Mode')
                            ->placeholder('test or live')
                            ->default('test'),
                        TextInput::make('razorpay_key_id')->label('Key ID')
                            ->placeholder('rzp_test_...')
                            ->password()
                            ->revealable(),
                        TextInput::make('razorpay_key_secret')->label('Key Secret')
                            ->placeholder('Secret key')
                            ->password()
                            ->revealable(),
                    ]),
                ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            if ($value !== null && $value !== '') {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'group' => explode('_', $key)[0] ?? 'general', 'label' => str($key)->replace('_', ' ')->title()]
                );
            }
        }

        Notification::make()->title('Settings saved successfully.')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save'),
        ];
    }
}
