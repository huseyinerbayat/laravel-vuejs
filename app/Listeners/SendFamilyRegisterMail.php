<?php

namespace App\Listeners;

use App\Events\FamilyRegisterEvent;
use App\Mail\FamilyRegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendFamilyRegisterMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FamilyRegisterEvent  $event
     * @return void
     */
    public function handle(FamilyRegisterEvent $event)
    {
        $user = $event->user;
        $student = $event->student;
        /* Mail::to($user->email)->send(new FamilyRegisterMail($user)); */
        Mail::send('emails.register', ['user' => $user, 'student' => $student], function($message) use($user){
            $message->to($user->email, env('APP_NAME'))->subject('Kayıt başarıyla gerçekleştirildi!');
        });
        Log::info("listener");
    }
}
