<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Joke;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JokeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->getOutput()->error('No categories found.');
            return;
        }

        $seedData = [
            [
                "body" => "How do you keep a Rhino from charging?\r\n\r\nTake away its credit card.",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "Charging Rhino"
            ],
            [
                "body" => "How many actors does it take to change a light bulb? \r\n \r\nOnly one-they don't like to share the spotlight.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Actors"
            ],
            [
                "body" => "How many aerobics instructors does it take to change a lightbulb ? \r\nFive. Four to do it in perfect synchrony and one to stand there going \"To the left, and to the left, and to the left, and to the left, and take it out, and put it down, and pick it up, and put it in, and to the right, and to the right, and to the right, and to the right...\"",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Aerobic Instructors"
            ],
            [
                "body" => "How many auto mechanics does it take to change a light bulb? \r\n\r\nSix - One to force it with a hammer and five to go out for more bulbs.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Mechanics"
            ],
            [
                "body" => "How do you praise a computer?\r\nSay \"Data Boy\"!",
                "category_id" => $categories->where('name', 'Puns')->first()->id,
                "title" => "Computer"
            ],
            [
                "body" => "How many law professors does it take to change a lightbulb?\r\n\r\nHell, you need 250 just to lobby for the research grant.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Law Professor"
            ],
            [
                "body" => "Diplomacy: The ability to tell a person to go to hell in such a way that they look forward to the trip.",
                "category_id" => $categories->where('name', 'Other / Misc')->first()->id,
                "title" => "Definition of Diplomacy"
            ],
            [
                "body" => "Why didn't the skeleton go to the dance?\r\n\r\nBecause it had no body to go with.",
                "category_id" => $categories->where('name', 'Other / Misc')->first()->id,
                "title" => "Lone Bones"
            ],

            [
                "body" => "All things are possible - except skiing through a revolving door.",
                "category_id" => $categories->where('name', 'One Liners')->first()->id,
                "title" => "All Things"
            ],

            [
                "body" => "Knock, Knock \r\n\r\nWho's there? \r\n\r\nCows go. \r\n\r\nCows go who? \r\n\r\nNo, silly! Cows go moo!",
                "category_id" => $categories->where('name', 'Knock-Knock')->first()->id,
                "title" => "Cow"
            ],

            [
                "body" => "What is represented by this?\r\n\r\nWOWOLFOL \r\n\r\nWolf in sheep's clothing (wool)!",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "WOWOLFOL"
            ],

            [
                "body" => "Teacher: John, where are the Great Plains?\r\n\r\nJohn: At the airport.",
                "category_id" => $categories->where('name', 'Puns')->first()->id,
                "title" => "Great Plains"
            ],

            [
                "body" => "What do you call a dog in the sun?\r\nA Hot Dog!",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "Yum #1"
            ],
            [
                "body" => "Q. Why do people wear shamrocks on St. Patrick's day?\r\n\r\nA. Regular Rocks are too heavy!",
                "category_id" => $categories->where('name', 'Other / Misc')->first()->id,
                "title" => "St. Patrick's Day"
            ],

            [
                "body" => "How many country singers does it take to screw in a light bulb?\r\n\r\n1 to screw it in, and 3 to write a song about it.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Country Singers"
            ],

            [
                "body" => "How many psychologists does it take to change a light bulb?\r\n\r\nOnly one, but the bulb has got to WANT to change.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Psychologist Handyman"
            ],

            [
                "body" => "How many surrealists does it take to change a light bulb?\r\n\r\nFish!",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Light Bulb"
            ],

            [
                "body" => "How many actors does it take to change a light bulb? \r\n \r\nOnly one-they don't like to share the spotlight.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Actors"
            ],
            [
                "body" => "How many aerobics instructors does it take to change a lightbulb ? \r\nFive. Four to do it in perfect synchrony and one to stand there going \"To the left, and to the left, and to the left, and to the left, and take it out, and put it down, and pick it up, and put it in, and to the right, and to the right, and to the right, and to the right...\"",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Aerobic Instructors"
            ],
            [
                "body" => "How many auto mechanics does it take to change a light bulb? \r\n\r\nSix - One to force it with a hammer and five to go out for more bulbs.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Mechanics"
            ],

            [
                "body" => "How many FBI agents does it take to change a lightbulb?\r\nShut up! We'll be asking the questions here.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "FBI"
            ],
            [
                "body" => "How many philosophers does it take to change a lightbulb?\r\n\r\n3. One to change it and the other two to argue whether the lightbulb really exists.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Philosophers"
            ],

            [
                "body" => "Q. How many telemarketers does it take to change a light bulb?\r\n\r\nA. Only one, but he has to do it while you're eating dinner.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "How Many Telemarketers..."
            ],

            [
                "body" => "What's the difference between a dry cleaner and a lawyer?\r\n\r\nThe cleaner pays if he loses your suit.  A lawyer can lose your suit and still take you to the cleaners.",
                "category_id" => $categories->where('name', 'Lawyer')->first()->id,
                "title" => "Lawyer vs Dry Cleaner"
            ],

            [
                "body" => "How many managers does it take to change a light bulb?\r\n\r\nWe've formed a task force to study the problem of why light bulbs burn out and to figure out what, exactly, we as supervisors can do to make the bulbs work smarter, not harder.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Managers"
            ],
            [
                "body" => "How many shipping department personnel does it take to change a light bulb?\r\n\r\nWe can change the bulb in seven to ten working days, but if you call before 2 p.m. and pay an extra $15, we can get it changed overnight.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Shipping Department"
            ],
            [
                "body" => "How many management information services guys does it take to change a light bulb?\r\n\r\nMIS has received your request concerning your hardware problem and has assigned you request number 39712.  Please use this number for any future reference to the light bulb issue.",
                "category_id" => $categories->where('name', 'Lightbulb')->first()->id,
                "title" => "Information Service"
            ],

            [
                "body" => "What is the definition of a sick bird?\r\n\r\n Illegal",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "Sick Bird"
            ],

            [
                "body" => "What do you get when you cross a snake and a kangaroo?\r\n\r\n A jump rope",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "Snake and a Kangaroo"
            ],
            [
                "body" => "What do you get when you cross a kangaroo and a sheep?\r\n\r\n A sweater with pockets",
                "category_id" => $categories->where('name', 'Animal')->first()->id,
                "title" => "Kangaroo and a Sheep"
            ],
        ];

        $this->command->getOutput()->info("Shuffling Jokes");
        shuffle($seedData);
        $this->command->getOutput()->info("Shuffling Complete");

        $numRecords = count($seedData);
        $this->command->getOutput()->progressStart($numRecords);

        foreach ($seedData as $newJoke) {
            Joke::create($newJoke);
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();


    }
}
