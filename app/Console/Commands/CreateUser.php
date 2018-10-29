<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;


class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user in database';


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
     * @throws \Throwable
     * @return mixed
     */
    public function handle()
    {
        $inputs = [
            'email' => $this->ask('Enter email address'),
            'password' => $this->secret('Enter password (min:6)')
        ];

        $validator = Validator::make($inputs,
            [
                'email' => 'bail|required|string|email|unique:users',
                'password' => 'required|string|min:6',
            ]
        );

        if ($validator->fails()) {
            $this->alert('Validation failed!');
            $this->error($validator->messages()->first());
            return 1;
        }

        // Fetch all roles from database
        $roles = Role::all()->pluck('name')->toArray();

        $roleName = $this->choice('Choose a role', $roles);

        DB::beginTransaction();

        try {
            $this->line('Creating new user ...');
            $user = User::create([
                'email' => $inputs['email'],
                'password' => bcrypt($inputs['password']),
            ]);

            $this->line('Assigning role ...');
            $user->assignRole($roleName);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e);

            $this->alert('Error saving user!');
            $this->error($e->getMessage());
            return 1;
        }

        DB::commit();
        $this->info("User `{$user->email}` with role `{$roleName}` created.");
        return 0;

    }
}
