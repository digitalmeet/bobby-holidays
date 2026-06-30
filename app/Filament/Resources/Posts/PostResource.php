<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Models\Post;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'CMS';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Post')->columnSpanFull()->tabs([
                Tab::make('Content')->icon('heroicon-o-document-text')->columns(2)->schema([
                    TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                    TextInput::make('slug')->maxLength(255)->helperText('Auto-generated from title.'),
                    Select::make('category')->options([
                        'planning' => 'Travel Planning',
                        'destinations' => 'Destinations',
                        'tips' => 'Travel Tips',
                        'visa' => 'Visa & Docs',
                        'honeymoon' => 'Honeymoon',
                        'family' => 'Family Travel',
                        'budget' => 'Budget Travel',
                    ])->searchable(),
                    Textarea::make('excerpt')->rows(3)->maxLength(300)->columnSpanFull(),
                    RichEditor::make('content')->columnSpanFull()->extraAttributes(['style' => 'min-height: 350px']),
                    TagsInput::make('tags')->columnSpanFull(),
                ]),
                Tab::make('Media & SEO')->icon('heroicon-o-photo')->columns(2)->schema([
                    FileUpload::make('featured_image')->image()->directory('posts')->maxSize(2048)->columnSpanFull(),
                    TextInput::make('meta_title')->maxLength(70),
                    TextInput::make('read_time_minutes')->numeric()->label('Read Time (min)'),
                    Textarea::make('meta_description')->rows(3)->maxLength(160)->columnSpanFull(),
                    FileUpload::make('og_image')->image()->directory('posts/seo')->label('OG Image'),
                ]),
                Tab::make('Publishing')->icon('heroicon-o-eye')->columns(2)->schema([
                    Toggle::make('is_published')->label('Published')->default(false),
                    DateTimePicker::make('published_at')->label('Publish Date'),
                    Select::make('author_id')->label('Author')->relationship('author', 'name')->default(fn () => auth()->id()),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')->columns([
            ImageColumn::make('featured_image')->circular()->size(40),
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category')->badge()->color('gray'),
            TextColumn::make('author.name')->label('Author')->placeholder('—'),
            IconColumn::make('is_published')->boolean()->label('Published'),
            TextColumn::make('published_at')->date()->placeholder('Draft')->sortable(),
            TextColumn::make('created_at')->since()->sortable(),
        ])->filters([
            TernaryFilter::make('is_published')->label('Published'),
            SelectFilter::make('category')->options([
                'planning' => 'Travel Planning',
                'destinations' => 'Destinations',
                'tips' => 'Travel Tips',
                'visa' => 'Visa & Docs',
                'honeymoon' => 'Honeymoon',
                'family' => 'Family Travel',
                'budget' => 'Budget Travel',
            ]),
            SelectFilter::make('author_id')->label('Author')->relationship('author', 'name'),
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
