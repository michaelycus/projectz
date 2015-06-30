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

        Model::reguard();
    }
}

class ArticleTableSeeder extends Seeder {

    public function run()
    {
        $article = Article::create(array(
            'title' 		=> 'O “Espírito do Tempo” Personificado – Eduardo Galeano',
            'source_url' 	=> '',
            'project_url' 	=> 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1497&action=edit',
            'user_id' 		=> '4',
            'status' 		=> ARTICLE_STATUS_EDITING
        ));
        $article = Article::create(array(
            'title' 		=> 'Estudo confirma que a humanidade está na zona de perigo existencial',
            'source_url'    => '',
            'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1532&action=edit',
            'user_id'       => '1',
            'status' 		=> ARTICLE_STATUS_EDITING
        ));
        $article = Article::create(array(
            'title' 		=> 'Automatização está substituindo terceirização',
            'source_url'    => '',
            'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1090&action=edit',
            'user_id' 		=> '2',
            'status' 		=> ARTICLE_STATUS_PROOFREADING
        ));
        $article = Article::create(array(
            'title' 		=> 'Sobre o conceito "Zeitgeist" (Autor - Eduardo Cormanich)',
            'source_url'    => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1457&action=edit',
            'project_url'   => 'https://docs.google.com/document/d/1aju9A1e3igf-FfWD6nTj62tdk2h-eD2ecuLag070GSY/edit?usp=sharing',
            'user_id'       => '3',
            'status'        => ARTICLE_STATUS_PUBLISHED
        ));
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
        $video = Video::create(array(
            'title'         => 'Freeman Dyson on the Global Warming Hysteria April, 2015',
            'thumbnail'     => 'https://i.ytimg.com/vi/BiKfWdXXfIs/hqdefault.jpg',
            'source_url'    => 'https://www.youtube.com/watch?v=BiKfWdXXfIs',
            'project_url'   => 'https://www.youtube.com/watch?v=BiKfWdXXfIs',
            'status'        => VIDEO_STATUS_TRANSCRIPTION,
            'user_id'       => 1,
            'duration'      => 1367
        ));
        $video = Video::create(array(
            'title'         => '6 Fallout Vaults That Drove Everyone Super Crazy, Surprise',
            'thumbnail'     => 'https://i.ytimg.com/vi/bv40L5FaMcs/hqdefault.jpg',
            'source_url'    => 'https://www.youtube.com/watch?v=bv40L5FaMcs',
            'project_url'   => 'https://www.youtube.com/watch?v=bv40L5FaMcs',
            'status'        => VIDEO_STATUS_TRANSCRIPTION,
            'user_id'       => 2,
            'duration'      => 455
        ));
        $video = Video::create(array(
            'title'         => 'Brené Brown on Empathy',
            'thumbnail'     => 'https://i.ytimg.com/vi/1Evwgu369Jw/hqdefault.jpg',
            'source_url'    => 'https://www.youtube.com/watch?v=1Evwgu369Jw',
            'project_url'   => 'https://www.youtube.com/watch?v=1Evwgu369Jw',
            'status'        => VIDEO_STATUS_SYNCHRONIZATION,
            'user_id'       => 3,
            'duration'      => 174
        ));
    }
}
