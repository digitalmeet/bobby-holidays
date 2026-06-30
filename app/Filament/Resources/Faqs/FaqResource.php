<?php

namespace App\Filament\Resources\Faqs;

use App\Filament\Resources\Faqs\Pages\CreateFaq;
use App\Filament\Resources\Faqs\Pages\EditFaq;
use App\Filament\Resources\Faqs\Pages\ListFaqs;
use App\Models\Faq;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
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

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;
    protected static ?string $recordTitleAttribute = 'question';
    protected static string|UnitEnum|null $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 5;
    protected static ?string $label = 'FAQ';
    protected static ?string $pluralLabel = 'FAQs';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('FAQ Details')->compact()->schema([
                TextInput::make('question')->required()->maxLength(500)->columnSpanFull(),
                RichEditor::make('answer')->required()->columnSpanFull()->extraAttributes(['style' => 'min-height: 200px']),
                Select::make('category')->options([
                    'general' => 'General',
                    'booking' => 'Booking & Payment',
                    'visa' => 'Visa & Documents',
                    'cancellation' => 'Cancellation & Refund',
                    'travel' => 'During Travel',
                    'packages' => 'Packages',
                ])->default('general'),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->reorderable('sort_order')->columns([
            TextColumn::make('question')->searchable()->sortable()->limit(60),
            TextColumn::make('category')->badge()->color('gray'),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('sort_order')->numeric()->sortable(),
        ])->filters([
            TernaryFilter::make('is_active'),
            SelectFilter::make('category')->options([
                'general' => 'General',
                'booking' => 'Booking & Payment',
                'visa' => 'Visa & Documents',
                'cancellation' => 'Cancellation & Refund',
                'travel' => 'During Travel',
                'packages' => 'Packages',
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
            'index' => ListFaqs::route('/'),
            'create' => CreateFaq::route('/create'),
            'edit' => EditFaq::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
