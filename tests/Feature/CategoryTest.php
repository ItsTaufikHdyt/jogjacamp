<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_category()
    {
        $data = ['name' => 'New Category', 'is_publish' => 1];

        $this->postJson('/api/categories', $data)
             ->assertStatus(201)
             ->assertJson($data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $data = ['name' => 'Updated Category','is_publish' => 1];

        $this->putJson("/api/categories/{$category->id}", $data)
             ->assertStatus(200)
             ->assertJson($data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $this->deleteJson("/api/categories/{$category->id}")
             ->assertStatus(200);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_can_list_categories()
    {
        $categories = Category::factory(5)->create();

        $this->getJson('/api/categories')
             ->assertStatus(200)
             ->assertJsonCount(5);
    }

    /** @test */
    public function it_can_show_a_category()
    {
        $category = Category::factory()->create();

        $this->getJson("/api/categories/{$category->id}")
             ->assertStatus(200)
             ->assertJson($category->toArray());
    }
}
