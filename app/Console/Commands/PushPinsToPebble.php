<?php

namespace App\Console\Commands;

use App\Talk;
use Carbon\Carbon;
use Faker\Provider\zh_TW\DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Valorin\PinPusher\Pusher;
use Valorin\PinPusher\Pin;

class PushPinsToPebble extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pebble:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pushes upcoming talks to Pebble.';

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
        $talks = Talk::all();

        // for testing purposes
        //$talks = Talk::orderBy('starts_at')->skip(11)->take(1)->get();

        if ( ! $talks->count()) {
            return false;
        }

        $remindersPushed = [];
        foreach ($talks as $talk) {
            $this->pushTalk($talk, ! in_array($talk->starts_at, $remindersPushed));
            $remindersPushed[] = (string) $talk->starts_at;
        }
    }

    /**
     * @param Talk $talk
     * @param bool $sendReminder
     */
    private function pushTalk(Talk $talk, $sendReminder)
    {
        $timezone = new \DateTimeZone(config('app.timezone'));

        // Generic Layout
        $title  = $talk->title;
        $layout = new Pin\Layout\Calendar($title);
        $layout->setBody($talk->speaker ? $talk->speaker->name : 'n/a');

        if ($talk->track) {
            $location = $talk->track == 9 ? 'Unconf' : 'Track ' . $talk->track;
            $layout->setLocationName($location);
        }

        // Put it all together
        $pin = new Pin('talk-' . $talk->id,
            new \DateTime($talk->starts_at->subHour()->format('Y-m-d H:i:s'), $timezone), $layout);
            //new \DateTime('2015-10-02 22:45:00', $timezone), $layout);

        // add duration
        if ($talk->starts_at && $talk->ends_at) {
            $duration = $talk->ends_at->diffInMinutes($talk->starts_at);
            $pin->setDuration($duration);
        }

        // Reminders
        if ($sendReminder) {
            $reminders = [
                new Pin\Reminder\Generic(new \DateTime($talk->starts_at->subHour()->subMinutes(5)->format('Y-m-d H:i:s'), $timezone),
                //new Pin\Reminder\Generic(new \DateTime('2015-10-02 22:40:00', $timezone),
                    'Upcoming ' . ($talk->is_talk ? 'talks' : $talk->title),
                    Pin\Icon::TIMELINE_CALENDAR),
            ];
            $pin->setReminders($reminders);
        }

        $pusher = new Pusher();

        if (config('app.debug')) {
            $pusher->deleteShared(config('pebble.api_key'), $pin);
        }

        $pusher->pushShared(config('pebble.api_key'), ['all'], $pin);

        \Log::debug('Pushed pebble talk: ' . $title . ', reminder: ' . ($sendReminder ? 'yes' : 'no'));
    }
}
