<?php

namespace App\Filament\Admin\Resources\ProfileResource\Pages;

use App\Filament\Admin\Resources\ProfileResource;
use App\Models\Profile;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

    public function mount(): void
    {
        $record = Profile::first();

        if ($record) {
            $this->redirect(ProfileResource::getUrl('edit', ['record' => $record]));
        } else {
            $this->redirect(ProfileResource::getUrl('create'));
        }
    }
}
