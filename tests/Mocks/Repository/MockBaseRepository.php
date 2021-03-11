<?php


namespace BlueYetchy\LibCore\Tests\Mocks\Repository;


use BlueYetchy\LibCore\Repository\BaseRepository;
use BlueYetchy\LibCore\Tests\Database\Models\UserMock;

class MockBaseRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return UserMock::class;
    }
}