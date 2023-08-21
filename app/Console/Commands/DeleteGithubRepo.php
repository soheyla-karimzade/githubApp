<?php

namespace App\Console\Commands;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteGithubRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-github-repo {username} {reponame}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Repository in github for authorised user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');
        $reponame= $this->argument('reponame');
        $user = User::where('username', $username)->first();

        $github_token= $user->github_token;
        $url = "https://api.github.com/repos/{$username}/{$reponame}";

        $data = [
            'name' => $reponame,
            "description"=>"This is your repo with githubApi Laravel",
            "homepage"=>"https://github.com",
            "private"=>false,
            "is_template"=>true
        ];

        $data = json_encode($data);

        $curl_url = $url;
        $ch = curl_init($curl_url);

        $headers = [
            'Accept: application/vnd.github+json',
            'Authorization: Bearer '.$github_token,
            'X-GitHub-Api-Version: 2022-11-28',
            'User-Agent: AppGithub'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $response = json_decode($response);
        if($httpCode==204){
            Repository::where('user_id',$user->id)->where('name',$reponame)->delete();
            echo 'repository deleted';
            die;
        }
        dd($response->message) ;
    }
}
