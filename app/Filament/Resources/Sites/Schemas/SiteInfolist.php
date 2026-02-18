<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('site_name')
                    ->label('Site Name'),
                TextEntry::make('site_code')
                    ->label('Site Code'),
                TextEntry::make('client_name')
                    ->label('Client Name')
                    ->placeholder('-'),
                TextEntry::make('location')
                    ->label('Location'),
                TextEntry::make('date')
                    ->label('Date')
                    ->date(),
                TextEntry::make('number_of_employees')
                    ->label('Number of Employees'),
                TextEntry::make('shift')
                    ->label('Shift')
                    ->badge(),
                TextEntry::make('reporting_time')
                    ->label('Reporting Time')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->label('Status'),
            ]);
    }
}
