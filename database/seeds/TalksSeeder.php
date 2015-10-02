<?php

use App\Speaker;
use App\Talk;
use Illuminate\Database\Seeder;

class TalksSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $talks = $this->getTalks();

        foreach ($talks as $talk) {
            $this->createTalk($talk);
        }
    }

    /**
     * @param array $talk
     * @return Talk
     */
    private function createTalk($talk)
    {
        $data = [
            'is_talk'   => (int) $talk['is_talk'],
            'track'     => (int) $talk['track'] > 0 ? (int) $talk['track'] : null,
            'title'     => $talk['title'],
            'starts_at' => $talk['starts_at'],
            'ends_at'   => $talk['ends_at'],
        ];

        if (isset($talk['author']) && $talk['author']) {
            $speaker = Speaker::whereName($talk['author'])->first();

            return $speaker->talks()->create($data);
        }

        return Talk::create($data);
    }

    /**
     * @return array
     */
    private function getTalks()
    {
        return [
            // first day
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Registration', 'starts_at' => '2015-10-03 08:00:00', 'ends_at' => '2015-10-03 09:30:00'],
            ['author' => '', 'is_talk' => 0, 'track' => 1, 'title' => 'Opening Address', 'starts_at' => '2015-10-03 09:30:00', 'ends_at' => '2015-10-03 09:40:00'],
            ['author' => '', 'is_talk' => 0, 'track' => 1, 'title' => 'Platinum Sponsor Introduction', 'starts_at' => '2015-10-03 09:40:00', 'ends_at' => '2015-10-03 09:45:00'],
            ['author' => 'Meri Williams', 'is_talk' => 1, 'track' => 1, 'title' => 'Stealing People Lessons from Artificial Intelligence: ', 'starts_at' => '2015-10-03 09:45:00', 'ends_at' => '2015-10-03 10:35:00'],
            ['author' => 'Lorna Mitchell', 'is_talk' => 1, 'track' => 1, 'title' => 'What To Expect from PHP7', 'starts_at' => '2015-10-03 10:45:00', 'ends_at' => '2015-10-03 11:35:00'],
            ['author' => 'Derick Rethans', 'is_talk' => 1, 'track' => 2, 'title' => 'One extension, three engines', 'starts_at' => '2015-10-03 10:45:00', 'ends_at' => '2015-10-03 11:35:00'],
            ['author' => 'Michael Heap', 'is_talk' => 1, 'track' => 3, 'title' => 'Pipeline Architectures', 'starts_at' => '2015-10-03 10:45:00', 'ends_at' => '2015-10-03 11:35:00'],
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Break', 'starts_at' => '2015-10-03 11:35:00', 'ends_at' => '2015-10-03 12:00:00'],
            ['author' => 'Rob Allen', 'is_talk' => 1, 'track' => 1, 'title' => 'A First Look at ZF3', 'starts_at' => '2015-10-03 12:00:00', 'ends_at' => '2015-10-03 12:50:00'],
            ['author' => 'Andrea Faulds', 'is_talk' => 1, 'track' => 2, 'title' => 'Better late than never', 'starts_at' => '2015-10-03 12:00:00', 'ends_at' => '2015-10-03 12:50:00'],
            ['author' => 'James Mallison', 'is_talk' => 1, 'track' => 3, 'title' => 'Dependency Injection and Dependency Inversion in PHP', 'starts_at' => '2015-10-03 12:00:00', 'ends_at' => '2015-10-03 12:50:00'],
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Lunch', 'starts_at' => '2015-10-03 12:50:00', 'ends_at' => '2015-10-03 14:00:00'],
            ['author' => 'Juliette Reinders Folmer', 'is_talk' => 1, 'track' => 1, 'title' => 'Dotting your i\'s and crossing your t\'s - how to make good code great', 'starts_at' => '2015-10-03 14:00:00', 'ends_at' => '2015-10-03 14:50:00'],
            ['author' => 'Justin Carmony', 'is_talk' => 1, 'track' => 2, 'title' => 'Writing Interactive User Interfaces with PHP & React.js', 'starts_at' => '2015-10-03 14:00:00', 'ends_at' => '2015-10-03 14:50:00'],
            ['author' => 'James Titcumb', 'is_talk' => 1, 'track' => 3, 'title' => 'Diving into HHVM Extensions', 'starts_at' => '2015-10-03 14:00:00', 'ends_at' => '2015-10-03 14:50:00'],
            ['author' => 'Bastian Hofmann', 'is_talk' => 1, 'track' => 1, 'title' => 'HTTP/2.0 101 Introduction', 'starts_at' => '2015-10-03 15:00:00', 'ends_at' => '2015-10-03 15:50:00'],
            ['author' => 'Ciaran McNulty', 'is_talk' => 1, 'track' => 2, 'title' => 'Driving Design through Examples', 'starts_at' => '2015-10-03 15:00:00', 'ends_at' => '2015-10-03 15:50:00'],
            ['author' => 'Stuart Herbert', 'is_talk' => 1, 'track' => 3, 'title' => 'Introducing A Quality Model For MVC Applications', 'starts_at' => '2015-10-03 15:00:00', 'ends_at' => '2015-10-03 15:50:00'],
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Break', 'starts_at' => '2015-10-03 15:50:00', 'ends_at' => '2015-10-03 16:20:00'],
            ['author' => 'Beau Simensen', 'is_talk' => 1, 'track' => 1, 'title' => 'Hello, PSR-7.', 'starts_at' => '2015-10-03 16:20:00', 'ends_at' => '2015-10-03 17:10:00'],
            ['author' => 'Michelangelo van Dam', 'is_talk' => 1, 'track' => 2, 'title' => 'PHPUnit IV.III - Return of the tests', 'starts_at' => '2015-10-03 16:20:00', 'ends_at' => '2015-10-03 17:10:00'],
            ['author' => 'Chris Riley', 'is_talk' => 1, 'track' => 3, 'title' => 'You Attended Talk: an introduction to event sourcing', 'starts_at' => '2015-10-03 16:20:00', 'ends_at' => '2015-10-03 17:10:00'],
            ['author' => '', 'is_talk' => 0, 'track' => 1, 'title' => 'Platinum Sponsor & Prizes', 'starts_at' => '2015-10-03 17:20:00', 'ends_at' => '2015-10-03 18:15:00'],
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Evening Meal & Social', 'starts_at' => '2015-10-03 19:00:00', 'ends_at' => null],

            // second day
            ['author' => '', 'is_talk' => 0, 'track' => 1, 'title' => 'Opening Address', 'starts_at' => '2015-10-04 08:45:00', 'ends_at' => '2015-10-04 08:55:00'],
            ['author' => 'Michelangelo van Dam', 'is_talk' => 1, 'track' => 1, 'title' => '200K+ reasons why security is a must', 'starts_at' => '2015-10-04 09:00:00', 'ends_at' => '2015-10-04 09:45:00'],
            ['author' => 'Thijs Feryn', 'is_talk' => 1, 'track' => 2, 'title' => 'Getting things done with ElasticSearch', 'starts_at' => '2015-10-04 09:00:00', 'ends_at' => '2015-10-04 09:45:00'],
            ['author' => 'Quentin Adam', 'is_talk' => 1, 'track' => 3, 'title' => 'Why postgres SQL deserve noSQL fan respect', 'starts_at' => '2015-10-04 09:00:00', 'ends_at' => '2015-10-04 09:45:00'],
            ['author' => 'Rob Allen', 'is_talk' => 1, 'track' => 1, 'title' => 'Secure your web application with two-factor authentication', 'starts_at' => '2015-10-04 09:55:00', 'ends_at' => '2015-10-04 10:40:00'],
            ['author' => 'Andrew Moore', 'is_talk' => 1, 'track' => 2, 'title' => 'Magic with the PHP database connector mysqlnd', 'starts_at' => '2015-10-04 09:55:00', 'ends_at' => '2015-10-04 10:40:00'],
            ['author' => 'Michael Cullum', 'is_talk' => 1, 'track' => 3, 'title' => 'phpBB, Meet Symfony', 'starts_at' => '2015-10-04 09:55:00', 'ends_at' => '2015-10-04 10:40:00'],
            ['author' => '', 'is_talk' => 0, 'track' => null, 'title' => 'Break', 'starts_at' => '2015-10-04 10:40:00', 'ends_at' => '2015-10-04 11:10:00'],
            ['author' => 'Justin Carmony', 'is_talk' => 1, 'track' => 1, 'title' => 'Scaling & Managing Asynchronous Workers (and staying sane!)', 'starts_at' => '2015-10-04 11:10:00', 'ends_at' => '2015-10-04 11:55:00'],
            ['author' => 'Stuart Herbert', 'is_talk' => 1, 'track' => 2, 'title' => 'Ways To Measure Your ORM\'s Cost', 'starts_at' => '2015-10-04 11:10:00', 'ends_at' => '2015-10-04 11:55:00'],
            ['author' => 'Mike Bell', 'is_talk' => 1, 'track' => 3, 'title' => 'Mental Health, Open Source and You', 'starts_at' => '2015-10-04 11:10:00', 'ends_at' => '2015-10-04 11:55:00'],
            ['author' => 'Stefan Koopmanschap', 'is_talk' => 1, 'track' => 1, 'title' => 'Keynote:', 'starts_at' => '2015-10-04 12:05:00', 'ends_at' => '2015-10-04 12:50:00'],
            ['author' => '', 'is_talk' => 0, 'track' => 1, 'title' => 'Closing Remarks', 'starts_at' => '2015-10-04 12:05:00', 'ends_at' => '2015-10-04 13:00:00'],
        ];
    }

}
