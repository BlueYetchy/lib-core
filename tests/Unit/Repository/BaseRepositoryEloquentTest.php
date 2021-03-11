<?php


namespace BlueYetchy\LibCore\Tests\Unit\Repository;


use BlueYetchy\LibCore\Repository\BaseRepository;
use BlueYetchy\LibCore\Tests\Database\Models\UserMock;
use BlueYetchy\LibCore\Tests\Mocks\Repository\MockBaseRepository;
use BlueYetchy\LibCore\Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepositoryEloquentTest extends TestCase implements BaseRepositoryTestInterface
{

    /**
     * @var BaseRepository
     */
    private BaseRepository $baseRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrations();
        $this->baseRepository = $this->app->make(MockBaseRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function test_create_model()
    {
        $this->baseRepository->eloquent()->query()->create([
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
        $user = $this->baseRepository->eloquent()->query()->create([
            'name' => 'enutrof',
            'email' => 'enutrof@mail.com'
        ]);

        $user->update(['name' => 'xelor']);

        $this->assertDatabaseCount((new UserMock())->getTable(), 1);
        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'xelor']);
    }

    /**
     * @inheritDoc
     */
    public function test_delete_model()
    {
        $user = $this->baseRepository->eloquent()->query()->create([
            'name' => 'iop',
            'email' => 'iop@mail.com'
        ]);

        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'iop']);

        $user->delete();

        $this->assertDeleted($user);
    }

    /**
     * @inheritDoc
     */
    public function test_get_all_model()
    {
        $this->baseRepository->eloquent()->query()->create([
            'name' => 'ouginak',
            'email' => 'ouginak@mail.com'
        ]);
        $this->baseRepository->eloquent()->query()->create([
            'name' => 'feca',
            'email' => 'feca@mail.com'
        ]);

        $users = $this->baseRepository->eloquent()->all();

        self::assertEquals(2, $users->count());
    }

    /**
     * @inheritDoc
     */
    public function test_get_model()
    {
        $this->baseRepository->eloquent()->query()->create([
            'name' => 'roublard',
            'email' => 'roublard@mail.com'
        ]);

        $user = $this->baseRepository->eloquent()->query()->findOrFail(1);

        $this->assertNotNull($user);
    }

    /**
     * @inheritDoc
     */
    public function test_get_model_fail()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->baseRepository->eloquent()->query()->create([
            'name' => 'sadida',
            'email' => 'sadida@mail.com'
        ]);

        $this->baseRepository->eloquent()->query()->findOrFail(100);
    }
}