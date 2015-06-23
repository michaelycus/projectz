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
            'status' 		=> 0
        ));
        $article = Article::create(array(
            'title' 		=> 'Estudo confirma que a humanidade está na zona de perigo existencial',
            'source_url'    => '',
            'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1532&action=edit',
            'user_id'       => '1',
            'status' 		=> 1
        ));
        $article = Article::create(array(
            'title' 		=> 'Automatização está substituindo terceirização',
            'source_url'    => '',
            'project_url'   => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1090&action=edit',
            'user_id' 		=> '2',
            'status' 		=> 2
        ));
        $article = Article::create(array(
            'title' 		=> 'Sobre o conceito "Zeitgeist" (Autor - Eduardo Cormanich)',
            'source_url'    => 'https://blog.movimentozeitgeist.com.br/wp-admin/post.php?post=1457&action=edit',
            'project_url'   => 'https://docs.google.com/document/d/1aju9A1e3igf-FfWD6nTj62tdk2h-eD2ecuLag070GSY/edit?usp=sharing',
            'user_id'       => '3',
            'status'        => 3
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
            'email' 		=> 'graci@graci.com',
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
            'type'    => 'p_video_execute'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_video_create'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_article_execute'
        ]);

        DB::table('permissions')->insert([
            'user_id' => '1',
            'type'    => 'p_post_execute'
        ]);
    }
}



class VideoTableSeeder extends Seeder {

    public function run()
    {
        $video = Video::create(array(
            'title' => 'Chomsky & Krauss: An Origins Project Dialogue ',
            'source_url' => 'https://www.youtube.com/watch?v=Ml1G919Bts0',
            'status' => 1
        ));
    }
}
