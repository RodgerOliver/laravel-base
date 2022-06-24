<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfilePicturePrune extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile-picture:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all unused profile pictures';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!Storage::exists('profile_pictures/')) {
            $this->error('Storage "profile_pictures/" doe not exist.');
            return 1;
        }

        $files = Storage::files('profile_pictures/');

        foreach ($files as $file) {
            $filename = basename($file);
            if(User::where('profile_picture', $filename)->count() === 0) {
                Storage::delete($file);
                $this->info('Deleted file ' . $filename);
            }
        }

        $this->info('All profile pictures pruned successfully.');
        return 0;
    }
}
