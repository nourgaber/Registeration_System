<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class DeleteUnActiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete unactive users for 3 months';
    protected $userService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $unActiveUsers = $this->userService->getUnactiveUsers() ;
       if(count($unActiveUsers) > 0){
        $this->userService->deleteUsersByIds($unActiveUsers->pluck('id')->toArray());
       }
    }
}
