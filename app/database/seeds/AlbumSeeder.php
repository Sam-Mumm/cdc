<?php
use Faker\Factory as Faker;
class AlbumSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<20;$i++)
        {
            $album=new Album();
            $cd=new CD();
            
            // Albumtitel und Erscheinungsjahr generieren
            $album->title = $faker->unique()->sentence();
            $album->year = $faker->year();

            // IDs für Genre, Ressource (Datenträger), Künstler und Kategorie auswählen
            $genre = Genre::lists('id');
            $artist = Artist::lists('id');
            $category = Category::lists('id');
            $ressource = Ressource::lists('id');
            
            $album->genre_id=$genre[array_rand($genre,1)];
            $album->artist_id=$artist[array_rand($artist,1)];
            $album->category_id=$category[array_rand($category,1)];
            $album->ressource_id=$ressource[array_rand($ressource,1)];
            $album->save();
            
            // Erzeuge für jedes Album 1 bis maximal 6 CDs
            $cds=$faker->numberBetween(1,6);
            for($j=1; $j<=$cds; $j++)
            {
                $cd=new CD();            
                $cd->cd_no=$j;
                $cd->album_id = $album->id;
                $cd->save();
                
                // Erzeuge für jede CD zwischen 5 und 18 Tracks
                $tracks=$faker->numberBetween(5,18);
                for($k=1; $k<=$tracks; $k++)
                {
                    $track=new Track();
                    
 //                   $track->number=$k;
                    $track->name=$faker->sentence(4);
                    $track->length=$faker->numberBetween(30,3800);
                    $track->show_artist=$faker->numberBetween(0,1);
                    $track->rating=$faker->numberBetween(0,5);
                    $track->composer=$faker->firstName()." ".$faker->lastName();
                    $track->lyrics=$faker->sentence();
                    $track->artist_id=$artist[array_rand($artist,1)];
                    $track->cd_id=$cd->id;
                    
                    $track->save();
                    
                }
            }
            
            
            

       }
    }
}   
