<?php

namespace App\Filament\Resources;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class VerifyAction extends Action
{
    use cancustomizeprocess;

    public static function getDefaultName(): ?string
    {
        return 'verify';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->label(__('Verify Translator'));
        $this->modalHeading(fn (): string => __('Verify Translator', ['label' => $this->getRecordTitle()]));
        $this->modalSubmitActionLabel(__('Verify Translator'));
        $this->successNotificationTitle(__('Translator Verified'));
        $this->failureNotificationTitle(__('Translator Already Verified'));
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
