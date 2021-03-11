<?php


namespace BlueYetchy\LibCore\Tests\Database\Models;


use Illuminate\Database\Eloquent\Model;

class UserMock extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;
}