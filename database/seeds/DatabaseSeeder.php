<?php


use App\Article;
use App\User;
use App\Video;
use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('ArticleTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('PermissionTableSeeder');
        $this->call('VideoTableSeeder');
        $this->call('PostTableSeeder');

        Model::reguard();
    }
}

class ArticleTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        $states = unserialize(ARTICLE_STATUS);

        for($i=0; $i<100; $i++){
            $k = array_rand($states);
            $article = Article::create(array(
                'title' 		=> $faker->sentence(),
                'source_url' 	=> $faker->url,
                'project_url' 	=> $faker->url,
                'user_id' 		=> $faker->randomDigitNotNull,
                'status' 		=> $states[$k]
            ));
        }
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        $user = User::create(array(
            'facebook_user_id' => '10206432895324665',
            'name' 			=> 'Michael Marques',
            'first_name' 	=> 'Michael',
            'last_name' 	=> 'Marques',
            'email' 		=> 'michaelycus@gmail.com',
            'password'      => bcrypt('secret')
        ));
        $user = User::create(array(
            'facebook_user_id' => '100000399419035',
            'name' 			=> 'José Roberto Sousa',
            'first_name' 	=> 'José',
            'last_name' 	=> 'Roberto Sousa',
            'email' 		=> 'jose@jose.com',
            'password'      => bcrypt('secret')
        ));
        $user = User::create(array(
            'facebook_user_id' => '100000096065425',
            'name' 			=> 'Graciela Kunrath Lima',
            'first_name' 	=> 'Graciela',
            'last_name' 	=> 'Kunrath Lima',
            'email' 		=> 'graciela@graciela.com',
            'password'      => bcrypt('secret')
        ));
        $user = User::create(array(
            'facebook_user_id' => '100002775557112',
            'name' 			=> 'Juliana Thiesen Fuchs',
            'first_name' 	=> 'Juliana',
            'last_name' 	=> 'Thiesen Fuchs',
            'email' 		=> 'juliana@juliana.com',
            'password'      => bcrypt('secret')
        ));

        $user = User::create(array(
            'facebook_user_id' => '100000956255058',
            'name' 			=> 'Daniela Madanelo',
            'first_name' 	=> 'Daniela',
            'last_name' 	=> 'Madanelo',
            'email' 		=> 'd@d.com',
            'password'      => bcrypt('secret')
        ));

        $user = User::create(array(
            'facebook_user_id' => '1207089492',
            'name' 			=> 'Rodrigo Nishino Zeitgeist',
            'first_name' 	=> 'Rodrigo',
            'last_name' 	=> 'Nishino Zeitgeist',
            'email' 		=> 'r@r.com',
            'password'      => bcrypt('secret')
        ));

        $user = User::create(array(
            'facebook_user_id' => '1066224340',
            'name' 			=> 'Arthur Helfstein Fragoso',
            'first_name' 	=> 'Arthur',
            'last_name' 	=> 'Helfstein Fragoso',
            'email' 		=> 'a@a.com',
            'password'      => bcrypt('secret')
        ));

        $user = User::create(array(
            'facebook_user_id' => '826528851',
            'name' 			=> 'Gustavo Canto',
            'first_name' 	=> 'Gustavo',
            'last_name' 	=> 'Canto',
            'email' 		=> 'g@g.com',
            'password'      => bcrypt('secret')
        ));

        $user = User::create(array(
            'facebook_user_id' => '659120626',
            'name' 			=> 'Bruna Sahão',
            'first_name' 	=> 'Bruna',
            'last_name' 	=> 'Sahão',
            'email' 		=> 'b@b.com',
            'password'      => bcrypt('secret')
        ));

    }
}

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_sys_1'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_vid_2'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_art_1'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_pos_1'
        ]);
    }
}

class VideoTableSeeder extends Seeder {

    public function run()
    {
        $states = unserialize(VIDEO_STATUS);

        $videos = array(
            'https://www.youtube.com/watch?v=6PxtSO-z8cI', 'https://www.youtube.com/watch?v=-c_8h-EqhaY',
            'https://www.youtube.com/watch?v=m_SlH3Uwslc', 'https://www.youtube.com/watch?v=Pk2oW4SDDxY',
            'https://www.youtube.com/watch?v=CmFNH7ZYdUY', 'https://www.youtube.com/watch?v=WzYXU2b_6cM',
            'https://www.youtube.com/watch?v=Yhky27lOuGY', 'https://www.youtube.com/watch?v=EpUs8oNjuV8',
            'https://www.youtube.com/watch?v=MWcfkgMRjcE', 'https://www.youtube.com/watch?v=3Kp_TaiRBoo',
            'https://www.youtube.com/watch?v=EjpJqcM3X94', 'https://www.youtube.com/watch?v=ilwqfNUqnAE',
            'https://www.youtube.com/watch?v=QwPo0Y7BcEE', 'https://www.youtube.com/watch?v=URK9Z2G71j8',
            'https://www.youtube.com/watch?v=X31K6jammH0', 'https://www.youtube.com/watch?v=pyJnl2lw4pU',
            'https://www.youtube.com/watch?v=y1SDV8nxypE', 'https://www.youtube.com/watch?v=8eiZT419fZ0',
            'https://www.youtube.com/watch?v=15RHV9D1K-A', 'https://www.youtube.com/watch?v=ywefoM2CkxA',
            'https://www.youtube.com/watch?v=siI-eJUWeAo', 'https://www.youtube.com/watch?v=--Y4aN-0Gsc',
            'https://www.youtube.com/watch?v=8BGJ5PK1Adk', 'https://www.youtube.com/watch?v=y4LWcgDPQ2I',
            'https://www.youtube.com/watch?v=TRycRwPcP3k', 'https://www.youtube.com/watch?v=LybfPwCzs3g',
            'https://www.youtube.com/watch?v=w1H8EcOJbxY', 'https://www.youtube.com/watch?v=YxGULrzsqKI',
            'https://www.youtube.com/watch?v=PuNIwYsz7PI', 'https://www.youtube.com/watch?v=jIFK0NhMVws',
            'https://www.youtube.com/watch?v=s042DGqTAIg', 'https://www.youtube.com/watch?v=rOJNl4d0WiU',
            'https://www.youtube.com/watch?v=Pvy2g3-ZjOw', 'https://www.youtube.com/watch?v=KD6Boy6VJUQ',
            'https://www.youtube.com/watch?v=wrMqGVzEUBQ', 'https://www.youtube.com/watch?v=kNijb0q9CZc',
            'https://www.youtube.com/watch?v=W85962jHQMM', 'https://www.youtube.com/watch?v=U2Sn7VP22WE'   );

        $faker = Faker\Factory::create();

        foreach ($videos as $video) {
            $k = array_rand($states);
            Video::create(with(new Video)->handle(array(
                'source_url' => $video,
                'user_id'    => $faker->randomDigitNotNull,
                'status'     => $states[$k]
            )));
        }
    }
}

class PostTableSeeder extends Seeder {

    public function run()
    {
        $states = unserialize(VIDEO_STATUS);

        $videos = array(
            'https://www.youtube.com/watch?v=1HX5whMauMw',
            'http://blog.movimentozeitgeist.com.br/o-mito-da-democracia/',
            'https://www.youtube.com/watch?v=pHt8QguIQNA',
            'http://www.youtube.com/watch?v=-kxvIZQn9jY&list=PLU8CxBao7c51AaDj-be8EjduTGdZM1nJV',
            'https://www.youtube.com/watch?v=YxR5qqzZS-g',
            'https://www.facebook.com/socientifica/videos/477273749105722/',
            'https://www.youtube.com/watch?v=WzYXU2b_6cM',
            'http://blog.movimentozeitgeist.com.br/nacionalismo-uma-doenca-infantil-parte-1/',
            'https://www.youtube.com/watch?v=qonClbGevVM',
            'https://www.youtube.com/watch?v=MBlWEOHqdOU',
            'http://on.rt.com/xnhsio',
            'https://www.youtube.com/watch?v=fRRCqr-REh4',
            'http://tinyurl.com/kptgj58',
            'https://zeitgeistphiladelphia.wordpress.com/2015/07/02/zeitgeist-philadelphia-to-speak-at-tesla-night-2015-teslas-people-party/',
            'https://www.youtube.com/watch?v=jayTknqC2uc',
            'https://www.youtube.com/watch?v=WJWVADbD3yY',
            'http://inhabitat.com/dutch-city-to-hand-out-free-basic-income-in-new-social-experiment/',
            'https://www.youtube.com/watch?v=BTS6rpD-rtI',
            'https://www.youtube.com/watch?v=7znX0yPuOw8',
            'http://www.blogtalkradio.com/zmglobal/2015/07/02/tzm-global-ep-176-james-phillips-010715-subject-riding-the-trojan-horse',
            'http://billmoyers.com/2014/04/19/high-inequality-results-in-more-us-deaths-than-tobacco-car-crashes-and-guns-combined/',
            'https://www.youtube.com/watch?v=0QNiZfSsPc0',
            'http://www.postcarbon.org/renewable-energy-will-not-support-economic-growth/',
            'http://t.co/34wOh19egm',
            'https://www.youtube.com/watch?v=O3XyDLbaUmU',
            'http://ose-21.org/',
            'https://www.youtube.com/watch?v=--aCydjT6jE',
            'https://www.youtube.com/watch?v=NP-DpGN84jk',
            'https://instagram.com/p/2eLK5uxgeF/',
            'https://www.youtube.com/watch?v=jh8supIUj6c',
            'http://www.alternet.org/belief/sam-harris-made-himself-look-idiot-email-exchange-chomsky-and-has-shared-it-world'  );

        $faker = Faker\Factory::create();

        foreach ($videos as $video) {
            $k = array_rand($states);
            Video::create(with(new Video)->handle(array(
                'source_url' => $video,
                'user_id'    => $faker->randomDigitNotNull,
                'status'     => $states[$k]
            )));
        }
    }
}
