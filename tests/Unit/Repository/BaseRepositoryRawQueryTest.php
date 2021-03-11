<?php


namespace BlueYetchy\LibCore\Tests\Unit\Repository;


use BlueYetchy\LibCore\Repository\BaseRepository;
use BlueYetchy\LibCore\Tests\Database\Models\UserMock;
use BlueYetchy\LibCore\Tests\Mocks\Repository\MockBaseRepository;
use BlueYetchy\LibCore\Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepositoryRawQueryTest extends TestCase implements BaseRepositoryTestInterface
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
        $this->baseRepository->rawQuery()->insert([
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
        $this->baseRepository->rawQuery()->insert([
            'name' => 'enutrof',
            'email' => 'enutrof@mail.com'
        ]);

        $this->baseRepository->rawQuery()->where('id', 1)->update([
            'name' => 'xelor'
        ]);

        $this->assertDatabaseCount((new UserMock())->getTable(), 1);
        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'xelor']);
    }

    /**
     * @inheritDoc
     */
    public function test_delete_model()
    {
        $this->baseRepository->rawQuery()->insert([
            'name' => 'iop',
            'email' => 'iop@mail.com'
        ]);

        $this->assertDatabaseHas((new UserMock())->getTable(), ['name' => 'iop']);

        $result = $this->baseRepository->rawQuery()->delete(1);

        $this->assertDatabaseCount((new UserMock())->getTable(), 0);
    }

    /**
     * @inheritDoc
     */
    public function test_get_all_model()
    {
        $this->baseRepository->rawQuery()->insert([
            'name' => 'ouginak',
            'email' => 'ouginak@mail.com'
        ]);
        $this->baseRepository->rawQuery()->insert([
            'name' => 'feca',
            'email' => 'feca@mail.com'
        ]);

        $users = $this->baseRepository->rawQuery()->get();

        self::assertEquals(2, $users->count());
    }

    /**
     * @inheritDoc
     */
    public function test_get_model()
    {
        $this->baseRepository->rawQuery()->insert([
            'name' => 'roublard',
            'email' => 'roublard@mail.com'
        ]);

        $user = $this->baseRepository->rawQuery()->find(1);

        $this->assertNotNull($user);
    }

    /**
     * @inheritDoc
     */
    public function test_get_model_fail()
    {
        $this->baseRepository->rawQuery()->insert([
            'name' => 'sadida',
            'email' => 'sadida@mail.com'
        ]);

        $user = $this->baseRepository->rawQuery()->find(100);

        $this->assertNull($user);
    }
}