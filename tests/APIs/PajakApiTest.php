<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Pajak;

class PajakApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pajak()
    {
        $pajak = Pajak::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pajaks', $pajak
        );

        $this->assertApiResponse($pajak);
    }

    /**
     * @test
     */
    public function test_read_pajak()
    {
        $pajak = Pajak::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pajaks/'.$pajak->id
        );

        $this->assertApiResponse($pajak->toArray());
    }

    /**
     * @test
     */
    public function test_update_pajak()
    {
        $pajak = Pajak::factory()->create();
        $editedPajak = Pajak::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pajaks/'.$pajak->id,
            $editedPajak
        );

        $this->assertApiResponse($editedPajak);
    }

    /**
     * @test
     */
    public function test_delete_pajak()
    {
        $pajak = Pajak::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pajaks/'.$pajak->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pajaks/'.$pajak->id
        );

        $this->response->assertStatus(404);
    }
}
