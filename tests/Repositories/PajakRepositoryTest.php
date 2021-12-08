<?php namespace Tests\Repositories;

use App\Models\Pajak;
use App\Repositories\PajakRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PajakRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PajakRepository
     */
    protected $pajakRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pajakRepo = \App::make(PajakRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pajak()
    {
        $pajak = Pajak::factory()->make()->toArray();

        $createdPajak = $this->pajakRepo->create($pajak);

        $createdPajak = $createdPajak->toArray();
        $this->assertArrayHasKey('id', $createdPajak);
        $this->assertNotNull($createdPajak['id'], 'Created Pajak must have id specified');
        $this->assertNotNull(Pajak::find($createdPajak['id']), 'Pajak with given id must be in DB');
        $this->assertModelData($pajak, $createdPajak);
    }

    /**
     * @test read
     */
    public function test_read_pajak()
    {
        $pajak = Pajak::factory()->create();

        $dbPajak = $this->pajakRepo->find($pajak->id);

        $dbPajak = $dbPajak->toArray();
        $this->assertModelData($pajak->toArray(), $dbPajak);
    }

    /**
     * @test update
     */
    public function test_update_pajak()
    {
        $pajak = Pajak::factory()->create();
        $fakePajak = Pajak::factory()->make()->toArray();

        $updatedPajak = $this->pajakRepo->update($fakePajak, $pajak->id);

        $this->assertModelData($fakePajak, $updatedPajak->toArray());
        $dbPajak = $this->pajakRepo->find($pajak->id);
        $this->assertModelData($fakePajak, $dbPajak->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pajak()
    {
        $pajak = Pajak::factory()->create();

        $resp = $this->pajakRepo->delete($pajak->id);

        $this->assertTrue($resp);
        $this->assertNull(Pajak::find($pajak->id), 'Pajak should not exist in DB');
    }
}
