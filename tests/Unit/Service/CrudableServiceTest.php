<?php


namespace BlueYetchy\LibCore\Tests\Unit\Service;


use BlueYetchy\LibCore\Repository\BaseRepository;
use BlueYetchy\LibCore\Service\CrudableService;
use BlueYetchy\LibCore\Tests\Database\Models\UserMock;
use BlueYetchy\LibCore\Tests\Mocks\Service\MockCrudableService;
use BlueYetchy\LibCore\Tests\TestCase;
use BlueYetchy\LibCore\Tests\Unit\Repository\BaseRepositoryTestInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CrudableServiceTest extends TestCase implements BaseRepositoryTestInterface
{
    /**
     * @var CrudableService
     */
    private $crudableService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrations();
        $this->crudableService = $this->app->make(MockCrudableService::class);
    }

    /**
     * @inheritDoc
     */
    public function test_create_model()
    {
        $this->crudableService->create([
            'name' => 'ecaflip',
            'email' => 'ecaflip@mail.com'
        ]);

        $this->assertDatabaseCount((new UserMock())->getTable(), 1);
        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'ecaflip']);
    }

    /**
     * @inheritDoc
     */
    public function test_update_model()
    {
        $user = $this->crudableService->create([
            'name' => 'enutrof',
            'email' => 'enutrof@mail.com'
        ]);

        $this->crudableService->update($user, ['name' => 'xelor']);

        $this->assertDatabaseCount((new UserMock())->getTable(), 1);
        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'xelor']);
    }

    /**
     * @inheritDoc
     */
    public function test_delete_model()
    {
        $user = $this->crudableService->create([
            'name' => 'iop',
            'email' => 'iop@mail.com'
        ]);

        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'iop']);

        $this->crudableService->delete($user);

        $this->assertDeleted($user);
    }

    /**
     * @inheritDoc
     */
    public function test_get_all_model()
    {
        $this->crudableService->create([
            'name' => 'ouginak',
            'email' => 'ouginak@mail.com'
        ]);
        $this->crudableService->create([
            'name' => 'feca',
            'email' => 'feca@mail.com'
        ]);

        $users = $this->crudableService->all();

        self::assertEquals(2, $users->count());
    }

    /**
     * @inheritDoc
     */
    public function test_get_model()
    {
        $this->crudableService->create([
            'name' => 'roublard',
            'email' => 'roublard@mail.com'
        ]);

        $user = $this->crudableService->getById(1);

        $this->assertNotNull($user);
    }

    /**
     * @inheritDoc
     */
    public function test_get_model_fail()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->crudableService->create([
            'name' => 'sadida',
            'email' => 'sadida@mail.com'
        ]);

        $this->crudableService->getById(100);
    }

    public function test_get_repository()
    {
        $this->assertInstanceOf(BaseRepository::class, $this->crudableService->getRepository());
    }
}