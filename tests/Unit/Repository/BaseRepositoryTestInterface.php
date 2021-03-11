<?php


namespace BlueYetchy\LibCore\Tests\Unit\Repository;


interface BaseRepositoryTestInterface
{
    /**
     * Create model
     */
    public function test_create_model();

    /**
     * Update model
     */
    public function test_update_model();

    /**
     * Delete model
     */
    public function test_delete_model();

    /**
     * Get all model
     */
    public function test_get_all_model();

    /**
     * Get one model by id
     */
    public function test_get_model();

    /**
     * Get one model by id with fail
     */
    public function test_get_model_fail();
}