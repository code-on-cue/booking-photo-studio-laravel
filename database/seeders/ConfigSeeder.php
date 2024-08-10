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
                'appName' => 'Foto Studio Glam',

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

                'whatsapp' => '6281386764224',
                'instagram' => 'heystudio.id',
                'address' => 'Jl Raya Cisoka - Adiyasa, Kp. Pasanggrahan, Kec. Solear, Kabupaten Tangerang, Banten 15730',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15830.120924689692!2d112.79868965!3d-7.2941646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb003665e2ed%3A0xd237e703c1a71bb1!2sCosyhouse%20Keputih%20Surabaya!5e0!3m2!1sen!2sid!4v1723332605015!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ]
        );
    }
}
