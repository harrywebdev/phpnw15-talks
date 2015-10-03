<?php

use App\Speaker;
use Illuminate\Database\Seeder;

class SpeakersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $speakers = $this->getSpeakers();

        foreach ($speakers as $speaker) {
            Speaker::create(['name' => $speaker]);
        }
    }

    /**
     * @return array
     */
    private function getSpeakers()
    {
        return [
            "Meri Williams",
            "Rob Allen",
            "Michael Heap",
            "Liam Wiltshire",
            "Wim Godden",
            "Thijs Feryn",
            "Lorna Mitchell",
            "Juliette Reinders Folmer",
            "James Mallison",
            "Mark Baker",
            "Stefan Koopmanschap",
            "Michelangelo van Dam",
            "James Titcumb",
            "Ciaran McNulty",
            "Beau Simensen",
            "Jakub Zalas",
            "Antonis Pavlakis",
            "Derick Rethans",
            "Andrea Faulds",
            "Justin Carmony",
            "Bastian Hofmann",
            "Chris Riley",
            "Quentin Adam",
            "Andrew Moore",
            "Michael Cullum",
            "Stuart Herbert",
            "Mike Bell",
            "Billie Thompson",
            "Matt Cockayne",
            "Andy Burgin",
            "Dennis de Greef",
            "Gabriela D'Ávila",
            "Mark Bradley",
            "Gabriel Somoza",
            "MIchael Cullum",
            "Endijs Lisovskis",
        ];
    }
}
