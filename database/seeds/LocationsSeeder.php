<?php
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{

    /*
     * A -1...8
     * B -1...7
     * C -1...8
     * D -1...7
     * E -2...7
     * T (maybe 0) or (-1...1)
    */
    public function run()
    {
        \DB::table('locations')->delete();

        $tall_blocks = [ 'A', 'C' ];
        $short_blocks = [ 'B', 'D' ];
        $tiny_blocks = [ 'T' ];

        $data = [];

        for ($i = -2; $i <= 7; $i++) {
            $data[] = [ 'block' => 'E', 'level' => $i ];
        }

        foreach ($tall_blocks as $block) {
            for ($i = -1; $i <= 8; $i++) {
                $data[] = [ 'block' => $block, 'level' => $i ];
            }
        }

        foreach ($short_blocks as $block) {
            for ($i = -1; $i <= 7; $i++) {
                $data[] = [ 'block' => $block, 'level' => $i ];
            }
        }

        foreach ($tiny_blocks as $block) {
            for ($i = -1; $i <= 1; $i++) {
                $data[] = [ 'block' => $block, 'level' => $i ];
            }
        }

        foreach ($data as &$row) {
            $row['created_at'] = $row['updated_at'] = \Carbon\Carbon::now();
        }

        App\Location::insert($data);
    }
}
