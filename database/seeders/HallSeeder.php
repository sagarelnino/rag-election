<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $halls = [
            'AFM Kamaluddin Hall',
            'Mir Mosharraf Hossain Hall',
            'Shaheed Salam-Barkat Hall',
            'Bangabandhu Sheikh Mujibur Rahman Hall',
            'Al Beruni Hall',
            'Shaheed Rafiq-Jabbar Hall',
            'Mowlana Bhashani Hall',
            'Bishwakabi Rabindranath Tagore Hall',
            'Jahanara Imam Hall',
            'Nawab Faizunnesa Hall',
            'Pritilata Hall',
            'Fazilatunnesa Hall',
            'Begum Khaleda Zia Hall',
            'Sheikh Hasina Hall',
            'Bangamata Begum Fazilatunnessa Mujib Hall',
            'Begum Sufia Kamal Hall',
        ];

        foreach ($halls as $hall) {
            Hall::create([
                'hall' => $hall
            ]);
        }
    }
}
