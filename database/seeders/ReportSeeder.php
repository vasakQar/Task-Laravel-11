<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Report::truncate();
        $startDate = Carbon::create(2024, 3, 2);
        $endDate = Carbon::create(2024, 3, 12);
        $websites = Website::all();

        foreach ($websites as $website) {
            $date = $startDate->copy();
            while ($date->lte($endDate)) {
                $isExists = Report::where('website_id', $website->id)
                    ->where('date', $date->format('Y-m-d'))
                    ->exists();

                if (!$isExists) {
                    Report::factory()->create([
                        'website_id' => $website->id,
                        'date' => $date->format('Y-m-d'),
                    ]);
                }

                $date->addDay();
            }
        }
    }
}
