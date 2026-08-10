<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Filament\Resources\TourResource\RelationManagers;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\HasManyRepeater;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true),

                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated(),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->required(),
            ]),

            Textarea::make('overview')
                ->rows(5)
                ->columnSpanFull(),

            Grid::make(3)->schema([
                TextInput::make('duration_days')->numeric(),
                TextInput::make('group_size')->numeric(),
            ]),

            Grid::make(2)->schema([
                DatePicker::make('available_from'),
                DatePicker::make('available_to'),
            ]),

            Grid::make(3)->schema([
                TextInput::make('price_adult')->numeric(),
                TextInput::make('price_youth')->numeric(),
                TextInput::make('price_child')->numeric(),
            ]),

            Grid::make(3)->schema([
                TextInput::make('extra_service_booking')->numeric(),
                TextInput::make('extra_service_adult')->numeric(),
                TextInput::make('extra_service_youth')->numeric(),
            ]),

            Textarea::make('highlights')
                ->label('Highlights')
                ->rows(5)
                ->helperText('Enter each highlight on a new line')
                ->afterStateHydrated(function (callable $set, $state) {

                    $set('highlights', is_array($state) ? implode("\n", $state) : $state);
                })
                ->dehydrateStateUsing(function ($state) {

                    return array_filter(array_map('trim', explode("\n", $state)));
                })
                ->nullable()
                ->columnSpanFull(),


            Textarea::make('included')
                ->label('Included Services')
                ->rows(4)
                ->helperText('One item per line.')
                ->afterStateHydrated(fn ($set, $state) =>
                $set('included', is_array($state) ? implode("\n", $state) : $state)
                )
                ->dehydrateStateUsing(fn ($state) =>
                array_filter(array_map('trim', explode("\n", $state)))
                )
                ->nullable()
                ->columnSpanFull(),

            Textarea::make('itinerary')
                ->label('Itinerary')
                ->rows(4)
                ->helperText('Day-wise plan: One line per day or step.')
                ->afterStateHydrated(fn ($set, $state) =>
                $set('itinerary', is_array($state) ? implode("\n", $state) : $state)
                )
                ->dehydrateStateUsing(fn ($state) =>
                array_filter(array_map('trim', explode("\n", $state)))
                )
                ->nullable()
                ->columnSpanFull(),

            Textarea::make('notes')
                ->label('Notes')
                ->rows(4)
                ->helperText('Enter each note on a separate line.')
                ->afterStateHydrated(fn ($set, $state) =>
                $set('notes', is_array($state) ? implode("\n", $state) : $state)
                )
                ->dehydrateStateUsing(fn ($state) =>
                array_filter(array_map('trim', explode("\n", $state)))
                )
                ->nullable()
                ->columnSpanFull(),

            HasManyRepeater::make('images')
                ->relationship('images')
                ->label('Tour Images')
                ->schema([
                    FileUpload::make('image_url')
                        ->image()
                        ->required()
                        ->directory('tours_img')
                        ->visibility('public'),
                ])
                ->defaultItems(1)
                ->addActionLabel('Add Image')
                ->columnSpanFull(),



        ]);

    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('destination.name')->label('Destination'),
            TextColumn::make('price_adult')->label('Price'),
            TextColumn::make('rating'),
            TextColumn::make('review_count'),
            TextColumn::make('available_from')->date(),
            TextColumn::make('available_to')->date(),
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
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
