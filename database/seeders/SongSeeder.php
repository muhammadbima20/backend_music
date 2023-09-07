<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('songs')->insert([
        	[
	            'song_name' => Str::random(10),
	            'artist_name' => Str::random(10),
	            'cover_image' => 'https://www.levelman.com/content/images/2023/05/eminem_kamikaze_b33s.jpg',
	        ],
        	[
	            'song_name' => Str::random(10),
	            'artist_name' => Str::random(10),
	            'cover_image' => 'https://media.gq-magazine.co.uk/photos/6308e538ee141ccaf8194ff1/master/w_1600%2Cc_limit/Arctic%2520monkey%2520car%2520album%2520car%2520hp_.jpg',
	        ],
	        [
	        	'song_name' => Str::random(10),
	        	'artist_name' => Str::random(10),
	        	'cover_image' => 'https://cdns-images.dzcdn.net/images/cover/711ea62cc98a8affb68a6d47a3f76abe/264x264.jpg'
	        ]
	    ]);
    }
}
