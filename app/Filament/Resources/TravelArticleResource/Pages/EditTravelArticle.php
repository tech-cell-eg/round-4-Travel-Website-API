<?php

namespace App\Filament\Resources\TravelArticleResource\Pages;

use App\Filament\Resources\TravelArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravelArticle extends EditRecord
{
    protected static string $resource = TravelArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
