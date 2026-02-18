<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Database\Eloquent\Model;
use Filament\Actions\Action;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
            ->color('warning'),
             Action::make('back')
                ->label('Back')
                ->color('gray')
                ->url(static::getResource()::getUrl()),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->user) {
            $data['user'] = [
                'name' => $this->record->user->name,
                'email' => $this->record->user->email,
            ];
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($record->user) {
            $userData = $data['user'];

            // Only update password if filled
            if (empty($userData['password'])) {
                unset($userData['password']);
            }

            $record->user->update($userData);
        }

        $record->update($data);

        return $record;
    }
}
