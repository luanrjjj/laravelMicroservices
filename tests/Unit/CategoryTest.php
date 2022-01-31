<?php

namespace Tests\Unit\Category;

use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    private $category;

    protected function setUp():void {
        parent::setUp();
        $this->category = new Category();
    }
 
    public function testFillable()
    {
        $fillable = ['name','description','is_active'];
       
        $this->assertEquals($fillable,$this->category->getFillable());   
    }
    public function testIfUseTraits() 
    {
        $traits = [
            SoftDeletes::class,Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits,$categoryTraits);
    }

    public function testCastsAttribute() 
    {
        $casts = ['id' =>'string','is_active'=>'boolean'];
        $this->assertEquals($casts,$this->category->getCasts());
    }
    public function testDatesAttribute() {
        $dates = ['deleted_at','created_at','updated_at'];
        foreach($dates as $date) {
            $this->assertContains($date,$this->category->getDates());
        }
        $this->assertCount(count($dates),$this->category->getDates());
    }
}
