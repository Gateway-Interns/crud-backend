<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\ReleaseNotification;

class SendReleaseNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:release-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New Release Notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            Mail::to($user->email)-> send(new ReleaseNotification($users));
        }
        $this -> info("a notification sent to all the users.");
    }
   
}
