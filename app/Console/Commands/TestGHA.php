<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Github\AuthMethod;
use Github\Client;
use Github\HttpClient\Builder;
use Github\ResultPager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Http;

class TestGHA extends Command
{
    protected $appApi;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = $this->newInstallationToken(config('gha.github_install_id'));
    }

    public function newInstallationToken($installId)
    {
        try {
            return $this->appApi()->apps()->createInstallationToken($installId) ?? ['token' => null, 'expires_at' => null];
        } catch (\Exception $e) {
            Log::error($e, [
                'github_installation_id' => $installId,
            ]);

            return ['token' => null, 'expires_at' => null];
        }
    }

    protected function appApi()
    {
        if ($this->appApi instanceof Client) {
            return $this->appApi;
        }

        $jwt = JWT::encode([
            'iat' => Carbon::now()->timestamp,
            'exp' => Carbon::now()->addMinutes(9.5)->timestamp,
            'iss' => config('gha.github_app_id'),
        ], file_get_contents(storage_path(config('gha.github_app_private_key'))), 'RS256');

        $this->appApi = new Client(new Builder, 'machine-man-preview');
        $this->appApi->authenticate($jwt, AuthMethod::JWT);

        return $this->appApi;
    }
}
