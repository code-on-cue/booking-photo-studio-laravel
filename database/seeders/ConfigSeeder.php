<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::create(
            [
                'appName' => 'Adhie Photo',

                'price' => 70000,
                'additionalPrice' => 30000,
                'maximumPerson' => 2,
                'openStore' => '09:00',
                'closeStore' => '21:00',
                'breakTime' => '12:00|12:30',
                'duration' => 30,

                'accountSource' => 'BRI',
                'accountNumber' => '043701076329500',
                'accountHolder' => 'Muhamad Arif Al Mahdi',

                'whatsapp' => '083853430400',
                'instagram' => 'Adhiephoto',
                'address' => 'Jl. RA Kartini No.17, Dermo, Kec. Bangil, Pasuruan, Jawa Timur 67153',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.7206171407615!2d112.79911527582135!3d-7.6053516751742105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7db49b4c16625%3A0xb08a523ca20b0c18!2sJl.%20R.A.Kartini%20No.17%2C%20Latek%20Lor%2C%20Dermo%2C%20Kec.%20Bangil%2C%20Pasuruan%2C%20Jawa%20Timur%2067153!5e0!3m2!1sen!2sid!4v1723912911527!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ]
        );
    }
}
