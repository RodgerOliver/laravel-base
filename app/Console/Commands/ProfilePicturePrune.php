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
     * Count of deleted files.
     *
     * @var integer
     */
    protected $count = 0;

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

        $files = array_filter($files, function($file) {
            return basename($file) !== '.gitignore'; // delete file from the list
        });

        $this->withProgressBar($files, function($file) use($storage_path) {
            $filename = basename($file);

            if(User::where('profile_picture', $filename)->count() === 0) {
                Storage::delete($file);
                info('Deleted file ' . $storage_path . $file);
                $this->count++;
            }
        });
        $this->info(''); // add new line after the progress bar

        if($this->count > 0) {
            $message = $this->count . ' profile pictures were pruned successfully.';
        } else {
            $message = 'No profile pictures pruned.';
        }

        $this->info($message);
        info($message);
        info('===== END PRUNE PROFILE PICTURES =====');

        return 0;
    }
}
