<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAcceptedOrRejectedNotification extends Notification
{
    use Queueable;

    public $studentCompanyField;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($studentCompanyField)
    {
        $this->studentCompanyField = $studentCompanyField;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'studentCompanyFieldId' => $this->studentCompanyField['id'],
            'student_no' => $this->studentCompanyField['student_no'],
            'student_name' => $this->studentCompanyField->student->student->name,
            'supervisor_no' => $this->studentCompanyField->student->supervisor_no,
            'company_name' => $this->studentCompanyField->companyField->company->name,
            'field_name' => $this->studentCompanyField->companyField->field->name,
            'status_company' => $this->studentCompanyField['status_company'],
        ];
    }
}
