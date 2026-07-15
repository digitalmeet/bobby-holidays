<?php

namespace App\Filament\Resources\CmsPages;

use App\Filament\Resources\CmsPages\Pages\CreateCmsPage;
use App\Filament\Resources\CmsPages\Pages\EditCmsPage;
use App\Filament\Resources\CmsPages\Pages\ListCmsPages;
use App\Models\Page;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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

class CmsPageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'Page';

    protected static ?string $pluralLabel = 'Pages';

    protected static ?string $slug = 'pages';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Page')->columnSpanFull()->tabs([
                Tab::make('Content')->icon('heroicon-o-document-text')->columns(2)->schema([
                    TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                    TextInput::make('slug')->maxLength(255)->helperText('Auto-generated. Used in URL: /page/{slug}'),
                    Toggle::make('is_published')->label('Published')->default(true),
                    Select::make('type')
                        ->options(['service' => 'Service Page'])
                        ->placeholder('Standard Page')
                        ->nullable()
                        ->helperText('Set to "Service Page" to appear under /services/'),
                    TextInput::make('icon')
                        ->placeholder('fa-solid fa-suitcase-rolling')
                        ->helperText('Font Awesome class — only used for service pages.')
                        ->nullable(),
                    Textarea::make('short_description')
                        ->rows(2)
                        ->helperText('Short summary shown on the services listing — only used for service pages.')
                        ->columnSpanFull()
                        ->nullable(),
                    RichEditor::make('content')->columnSpanFull()->extraAttributes(['style' => 'min-height: 400px']),
                ]),
                Tab::make('SEO')->icon('heroicon-o-magnifying-glass')->columns(2)->schema([
                    TextInput::make('meta_title')->maxLength(70)->helperText('Max 70 chars.'),
                    DateTimePicker::make('published_at')->label('Publish Date'),
                    Textarea::make('meta_description')->rows(3)->maxLength(160)->helperText('Max 160 chars.')->columnSpanFull(),
                    FileUpload::make('og_image')->image()->directory('pages/seo')->label('OG Image'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('title')->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('slug')->searchable()->color('gray')->prefix('/page/'),
            IconColumn::make('is_published')->boolean()->label('Published'),
            TextColumn::make('updated_at')->label('Last Updated')->since()->sortable(),
        ])->filters([
            TernaryFilter::make('is_published')->label('Published'),
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
            'index' => ListCmsPages::route('/'),
            'create' => CreateCmsPage::route('/create'),
            'edit' => EditCmsPage::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
