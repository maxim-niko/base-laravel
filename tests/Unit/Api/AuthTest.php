<?php

namespace Tests\Unit\Api;

use App\Models\Article;
use Laravel\Passport\Client as OAuthClient;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestDbAuthCase as Test;

/**
 * @property Article $article
 *
 * Class AuthTest
 * @package Tests\Unit\Api
 */
class AuthTest extends Test
{
    public function testAuth(): void
    {

        $client = factory(OAuthClient::class)->create();

        $response = $this->post('oauth/token', [
            'grant_type' => 'password',
            'username' => $this->user->email,
            'password' => 'secret',
            'client_id' => $client->id,
            'client_secret' => $client->secret
        ]);

        $this->assertTrue(Response::HTTP_OK === $response->getStatusCode());

        $response->assertJsonFragment([
            'expires_in' => 31536000,
            'token_type' => 'Bearer'
        ]);
    }

    public function testError(): void
    {
        $response = $this->post('oauth/token', [
            'grant_type' => 'password',
            'username' => $this->user->email,
            'password' => 'secret',
            'client_id' => 'client_id',
            'client_secret' => 'client_secret'
        ]);

        $this->assertTrue(Response::HTTP_UNAUTHORIZED === $response->getStatusCode());
        $this->assertJson($response->content());
    }

}
