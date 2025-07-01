<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\Type;
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

                'accountSource' => 'BRI',
                'accountNumber' => '043701076329500',
                'accountHolder' => 'Muhamad Arif Al Mahdi',

                'whatsapp' => '083853430400',
                'instagram' => 'Adhiephoto',
                'address' => 'Jl. RA Kartini No.17, Dermo, Kec. Bangil, Pasuruan, Jawa Timur 67153',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.7206171407615!2d112.79911527582135!3d-7.6053516751742105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7db49b4c16625%3A0xb08a523ca20b0c18!2sJl.%20R.A.Kartini%20No.17%2C%20Latek%20Lor%2C%20Dermo%2C%20Kec.%20Bangil%2C%20Pasuruan%2C%20Jawa%20Timur%2067153!5e0!3m2!1sen!2sid!4v1723912911527!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ]
        );

        Type::create([
            'name' => 'Portrait',
            'slug' => 'portrait',
            'banner' => 'portrait.jpg',
            'terms_and_conditions' => implode("\n", [
                '1. Biaya Rp75.000 untuk maksimal 2 orang.',
                '2. Tambahan orang dikenakan biaya Rp20.000/orang.',
                '3. Sesi berlangsung selama 30 menit.',
                '4. Jam buka studio: 09:00 - 21:00.',
                '5. Waktu istirahat: 12:00 dan 12:30.',
                '6. Harap datang 15 menit sebelum sesi dimulai.',
                '7. Semua soft file akan dikirim melalui Google Drive.',
            ]),
            'moreDetails' => [
                'price' => 75000,
                'additionalPrice' => 20000,
                'maximumPerson' => 2,
                'openStore' => '09:00',
                'closeStore' => '21:00',
                'breakTime' => '12:00|12:30',
                'duration' => 30
            ]
        ]);

        Type::create([
            'name' => 'Wedding',
            'slug' => 'wedding',
            'banner' => 'wedding.jpg',
            'terms_and_conditions' => implode("\n", [
                '1. Tersedia 3 paket pilihan:',
                '   - Silver: Rp3.000.000',
                '   - Gold: Rp5.000.000',
                '   - Platinum: Rp8.000.000',
                '2. Biaya tambahan lokasi:',
                '   - Jabodetabek: Gratis',
                '   - Luar Kota: Rp2.000.000',
                '   - Luar Negeri: Rp10.000.000',
                '3. Estimasi durasi sesi: 5-8 jam.',
                '4. Tim crew sudah termasuk dalam paket.',
                '5. Booking dilakukan minimal 7 hari sebelum acara.',
            ]),
            'moreDetails' => [
                'packageOptions' => [
                    ['name' => 'Silver', 'price' => 3000000],
                    ['name' => 'Gold', 'price' => 5000000],
                    ['name' => 'Platinum', 'price' => 8000000]
                ],
                'locationSurcharge' => [
                    'Jabodetabek' => 0,
                    'Luar Kota' => 2000000,
                    'Luar Negeri' => 10000000
                ],
                'crewIncluded' => true,
                'durationEstimate' => '5-8 jam'
            ]
        ]);

        Type::create([
            'name' => 'Keluarga',
            'slug' => 'keluarga',
            'banner' => 'family.jpg',
            'terms_and_conditions' => implode("\n", [
                '1. Sesi foto keluarga berdurasi 60 menit.',
                '2. Pilihan lokasi:',
                '   - Indoor: Rp500.000',
                '   - Outdoor: Rp700.000',
                '3. Harga tambahan berdasarkan jumlah orang:',
                '   - s.d. 5 orang: Gratis',
                '   - 6-10 orang: Tambahan Rp100.000',
                '   - 11-15 orang: Tambahan Rp200.000',
                '4. Termasuk cetakan foto (printed).',
                '5. Jam buka: 10:00 - 20:00',
                '6. Waktu istirahat: 13:00 dan 14:00',
            ]),
            'moreDetails' => [
                'locationOptions' => [
                    ['type' => 'Indoor', 'price' => 500000],
                    ['type' => 'Outdoor', 'price' => 700000],
                ],
                'personTier' => [
                    ['max' => 5, 'price' => 0],
                    ['max' => 10, 'price' => 100000],
                    ['max' => 15, 'price' => 200000],
                ],
                'includePrintedPhotos' => true,
                'duration' => 60,
                'openStore' => '10:00',
                'closeStore' => '20:00',
                'breakTime' => '13:00|14:00'
            ]
        ]);
    }
}
