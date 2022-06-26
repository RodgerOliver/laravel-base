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

        info('===== START PRUNE PROFILE PICTURES =====');
        $storage_path = Storage::path('profile_pictures/');
        $files = Storage::files('profile_pictures/');
        $progress_bar = $this->output->createProgressBar(count($files) - 1); // remove .gitignore from the counter
        $count = 0;

        foreach ($files as $file) {
            $filename = basename($file);

            if($filename === '.gitignore') {
                continue;
            }

            if(User::where('profile_picture', $filename)->count() === 0) {
                Storage::delete($file);
                info('Deleted file ' . $storage_path . $file);
                $count++;
            }
            $progress_bar->advance();
        }

        $progress_bar->finish();
        $this->info('');

        if($count > 0) {
            $message = $count . ' profile pictures were pruned successfully.';
        } else {
            $message = 'No profile pictures pruned.';
        }

        $this->info($message);
        info($message);
        info('===== END PRUNE PROFILE PICTURES =====');

        return 0;
    }
}
