<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Message; // تأكد من استدعاء الموديل هنا

class ContactForm extends Component
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:10')]
    public $message = '';

    public $successMessage = null;

    public function submit()
    {
        $this->validate();

        try {
            // حفظ البيانات في قاعدة البيانات
            Message::create([
                'name'    => $this->name,
                'email'   => $this->email,
                'subject' => 'رسالة من موقعي الشخصي', // قيمة افتراضية لأن الحقل مطلوب في Migration
                'message' => $this->message,
            ]);

            // تحديث رسالة النجاح
            $this->successMessage = __('messages.success_message_sent');

            // تصفير الحقول
            $this->reset(['name', 'email', 'message']);

        } catch (\Exception $e) {
            // إظهار الخطأ في التيرمينال أو الـ Log إذا فشل الحفظ
            session()->flash('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
