<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Resources\Testimonials\Pages\ListTestimonials;
use App\Models\Testimonial;
use BackedEnum;
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

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;
    protected static ?string $recordTitleAttribute = 'name';
    protected static string|UnitEnum|null $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Testimonial Details')->columns(2)->compact()->schema([
                TextInput::make('name')->required()->maxLength(255)->placeholder('Client name'),
                TextInput::make('location')->maxLength(255)->placeholder('e.g. Mumbai, India'),
                Select::make('rating')->options([5 => '★★★★★', 4 => '★★★★☆', 3 => '★★★☆☆', 2 => '★★☆☆☆', 1 => '★☆☆☆☆'])->default(5)->required(),
                Select::make('tour_id')->label('Related Tour')->relationship('tour', 'title')->searchable()->preload()->placeholder('None'),
                Textarea::make('content')->required()->rows(4)->placeholder('What the client said...')->columnSpanFull(),
                FileUpload::make('avatar')->image()->directory('testimonials')->avatar()->circleCropper(),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_featured')->default(false),
                Toggle::make('is_active')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->reorderable('sort_order')->columns([
            TextColumn::make('name')->searchable()->sortable()->description(fn ($record) => $record->location),
            TextColumn::make('rating')->formatStateUsing(fn (int $state) => str_repeat('★', $state) . str_repeat('☆', 5 - $state))->color('warning'),
            TextColumn::make('content')->limit(50),
            TextColumn::make('tour.title')->label('Tour')->placeholder('General')->limit(20),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            IconColumn::make('is_active')->boolean()->label('Active'),
        ])->filters([
            TernaryFilter::make('is_active'),
            TernaryFilter::make('is_featured'),
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
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
