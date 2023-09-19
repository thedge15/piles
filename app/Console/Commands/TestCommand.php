<?php

namespace App\Console\Commands;

use App\Models\Bush;
use App\Models\Project;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()->create(['name' => 'Павел22', 'email' => 'user222@user.ru', 'password' => Hash::make('123123123'), 'is_admin' => 1]);
        Bush::query()->create(['title' => '5А1422']);
        Project::query()->create(['bush_id' => 5, 'title' => '1778Р-ВЛ5А14-АС', 'change' => 1]);
        return Command::SUCCESS;
    }
}
