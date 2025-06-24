<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TravelArticleResource\Pages;
use App\Filament\Resources\TravelArticleResource\RelationManagers;
use App\Models\TravelArticle;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TravelArticleResource extends Resource
{
    protected static ?string $model = TravelArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->live(onBlur: true),

            TextInput::make('slug')
                ->required()
                ->disabled()
                ->dehydrated(),

            FileUpload::make('image_url')
                ->image()
                ->directory('customers_img')
                ->nullable(),

            Textarea::make('content')
                ->required()
                ->rows(10),

            TextInput::make('author')
                ->nullable(),

            TagsInput::make('tags')
                ->label('Tags (keywords)')
                ->placeholder('Add tags'),

            DateTimePicker::make('published_at')
                ->label('Published At')
                ->nullable(),

            TextInput::make('views_count')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('author')->sortable(),
                TextColumn::make('views_count')->sortable(),
                ImageColumn::make('image_url')->label('Image')->square(),
                TextColumn::make('published_at')->label('Published')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTravelArticles::route('/'),
            'create' => Pages\CreateTravelArticle::route('/create'),
            'edit' => Pages\EditTravelArticle::route('/{record}/edit'),
        ];
    }
}
