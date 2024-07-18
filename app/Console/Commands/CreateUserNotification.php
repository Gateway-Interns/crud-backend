<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\NewReleaseNotification;

class CreateUserNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:new-release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification to user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewReleaseNotification($user));
        }
        $this->info('new notf sent to all users.');
    }
}
