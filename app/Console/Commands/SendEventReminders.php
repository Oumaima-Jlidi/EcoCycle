<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Mail\EventReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'event:send-reminders';
    protected $description = 'Send reminder emails to participants for today\'s events';

    public function handle()
    {
        // Get today's events
        $today = Carbon::today();
        $events = Event::whereDate('start_date', $today)->with('registrations')->get();

        foreach ($events as $event) {
            foreach ($event->registrations as $registration) {
                Mail::to($registration->user->email)->send(new EventReminder($event));
            }
        }

        $this->info('Reminder emails sent for today\'s events!');
    }
}
