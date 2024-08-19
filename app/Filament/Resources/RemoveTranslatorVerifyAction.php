<?php

namespace App\Filament\Resources;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class RemoveTranslatorVerifyAction extends Action
{
    use cancustomizeprocess;

    public static function getDefaultName(): ?string
    {
        return 'remove_verify';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->label(__('Remove Verification'));
        $this->modalHeading(fn (): string => __('Remove Verification Status', ['label' => $this->getRecordTitle()]));
        $this->modalSubmitActionLabel(__('Remove Verification Status'));
        $this->successNotificationTitle(__('Verification Status Removed'));
        $this->failureNotificationTitle(__('Verification Status Already Removed'));
        $this->color('success');
        $this->icon(FilamentIcon::resolve('actions::verify-action') ?? 'heroicon-m-check');
        $this->requiresConfirmation();
        $this->action(function (Model $record): void {

            if ($record->verification_status == 'Not Verified') {
                $this->failure();
            } else {
                $record->update(['verification_status' => 'Not Verified']);
                $this->success();
            }

        });

    }
}
