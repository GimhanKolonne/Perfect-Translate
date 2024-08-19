<?php

namespace App\Filament\Resources;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class VerifyClientAction extends Action
{
    use cancustomizeprocess;

    public static function getDefaultName(): ?string
    {
        return 'verify';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->label(__('Verify Client'));
        $this->modalHeading(fn (): string => __('Verify Client', ['label' => $this->getRecordTitle()]));
        $this->modalSubmitActionLabel(__('Verify Client'));
        $this->successNotificationTitle(__('Client Verified'));
        $this->failureNotificationTitle(__('Client Already Verified'));
        $this->color('success');
        $this->icon(FilamentIcon::resolve('actions::verify-action') ?? 'heroicon-m-check');
        $this->requiresConfirmation();
        $this->action(function (Model $record): void {

            if ($record->verification_status == 'Verified') {
                $this->failure();
            } else {
                $record->update(['verification_status' => 'Verified']);
                $this->success();
            }

        });

    }
}
