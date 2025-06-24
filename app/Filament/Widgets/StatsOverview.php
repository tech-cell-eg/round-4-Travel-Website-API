<?php

namespace App\Filament\Widgets;

namespace App\Filament\Widgets;

use App\Models\TravelArticle;
use App\Models\Tour;
use App\Models\Activity;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Travel Articles', TravelArticle::count())
                ->description('Total published articles')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),

            Card::make('Tours', Tour::count())
                ->description('Total available tours')
                ->descriptionIcon('heroicon-o-globe-alt')
                ->color('success'),

            Card::make('Activities', Activity::count())
                ->description('Total activities listed')
                ->descriptionIcon('heroicon-o-light-bulb')
                ->color('warning'),
        ];
    }
}
