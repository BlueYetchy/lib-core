<?php


namespace BlueYetchy\LibCore\Tests\Mocks\Service;


use BlueYetchy\LibCore\Repository\BaseRepository;
use BlueYetchy\LibCore\Service\CrudableService;
use BlueYetchy\LibCore\Tests\Mocks\Repository\MockBaseRepository;

class MockCrudableService extends CrudableService
{

    /**
     * @inheritDoc
     */
    public function getRepositoryClass(): string
    {
        return MockBaseRepository::class;
    }
}