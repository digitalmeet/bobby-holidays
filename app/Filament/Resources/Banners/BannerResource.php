<?php

namespace App\Filament\Resources\Banners;

use App\Filament\Resources\Banners\Pages\CreateBanner;
use App\Filament\Resources\Banners\Pages\EditBanner;
use App\Filament\Resources\Banners\Pages\ListBanners;
use App\Models\Banner;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?string $recordTitleAttribute = 'title';
    protected static string|UnitEnum|null $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Details')->columns(2)->compact()->schema([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('subtitle')->maxLength(255),
                Textarea::make('description')->rows(3)->columnSpanFull(),
                TextInput::make('cta_text')->label('Button Text')->placeholder('e.g. Explore Now'),
                TextInput::make('cta_url')->label('Button URL')->url()->placeholder('https://...'),
                Select::make('position')->options([
                    'homepage_hero' => 'Homepage Hero',
                    'homepage_mid' => 'Homepage Middle',
                    'sidebar' => 'Sidebar',
                    'popup' => 'Popup',
                ])->default('homepage_hero'),
                TextInput::make('sort_order')->numeric()->default(0),
                FileUpload::make('image')->image()->directory('banners')->maxSize(2048)->columnSpanFull(),
                FileUpload::make('mobile_image')->image()->directory('banners/mobile')->maxSize(1024)->label('Mobile Image'),
                Toggle::make('is_active')->default(true),
                DateTimePicker::make('starts_at')->label('Start Date'),
                DateTimePicker::make('ends_at')->label('End Date'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->reorderable('sort_order')->columns([
            ImageColumn::make('image')->size(60),
            TextColumn::make('title')->searchable()->sortable()->limit(35),
            TextColumn::make('position')->badge()->color('gray'),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('starts_at')->date()->placeholder('Always'),
            TextColumn::make('ends_at')->date()->placeholder('Never'),
            TextColumn::make('sort_order')->numeric()->sortable(),
        ])->filters([
            TernaryFilter::make('is_active'),
            SelectFilter::make('position')->options([
                'homepage_hero' => 'Homepage Hero',
                'homepage_mid' => 'Homepage Middle',
                'sidebar' => 'Sidebar',
                'popup' => 'Popup',
            ]),
            TrashedFilter::make(),
        ])->recordActions([
            EditAction::make(), DeleteAction::make(), RestoreAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make(), RestoreBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
