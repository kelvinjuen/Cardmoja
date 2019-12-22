<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Notification;
use App\Notifications\CardView;
use Illuminate\Console\Command;
use App\User;
use App\GetCardViews;

class sendUsersLinkViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:weeklyCardViews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send users weekly summary card link view';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*$users = User::all();
        $users->map(function($user){
            $views = GetCardViews::new($user);
            $user->notify (new WeeklyCardViews($views, $user));
        });*/

        $users = User::all();
        $users->map(function($user){
            $views = GetCardViews::where('user_id', $user->user_id)->count();
            $details =['greeting' => 'Hi', 'body' => 'your CardMoja card has been viewed '.$views.' times.','thanks' => 'Please feel free to customize your notifications from CardMoja',
            'actionText' => 'Check out who has viewed your card', 'actionURL' => url('/'), 'notifiable_type' => '101' ];
            Notification::send($user, new CardView($details,$views));
        });

    }
}
