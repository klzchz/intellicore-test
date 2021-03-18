<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;


class CompanyControllerTest extends TestCase
{

    use RefreshDatabase;

	public function testIndex()
	{
        Company::factory()->count(5)->create();

        $result = $this->getJson(route("companies.index"));


        $result->assertStatus(Response::HTTP_OK);
        $result->assertJsonCount(5, 'data');
	}

	public function test_index_default_paginates_to_10()
    {
        Company::factory()->count(20)->create();

        $result = $this->getJson(route("companies.index"));


        $result->assertStatus(Response::HTTP_OK);
        $result->assertJsonCount(10, 'data');
        $result->assertJsonFragment(['total' => 20]);
    }

    public function test_index_returns_based_on_name_search()
    {
        Company::factory()->count(20)->create();
        Company::factory()->create(['name' => 'Test Name']);

        $result = $this->getJson(route("companies.index") . '?name=Test');


        $result->assertStatus(Response::HTTP_OK);
        $result->assertJsonCount(1, 'data');
        $result->assertJsonFragment(['total' => 1]);
        $result->assertJsonFragment(['name' => 'Test Name']);
    }

    public function test_index_returns_based_on_minimum_rating()
    {
        Company::factory()->count(20)->create(['rating' => random_int(0, 3)]);
        Company::factory()->count(5)->create(['rating' => 5]);

        $result = $this->getJson(route("companies.index") . '?rating_min=4');

        $result->assertStatus(Response::HTTP_OK);
        $result->assertJsonCount(5, 'data');
        $result->assertJsonFragment(['total' => 5]);
    }

    public function test_index_returns_based_on_max_rating()
    {
        Company::factory()->count(5)->create(['rating' => random_int(0, 3)]);
        Company::factory()->count(20)->create(['rating' => 5]);

        $result = $this->getJson(route("companies.index") . '?rating_max=4');

        $result->assertStatus(Response::HTTP_OK);
        $result->assertJsonCount(5, 'data');
        $result->assertJsonFragment(['total' => 5]);
    }

    public function test_admin_can_store_a_new_company()
    {
        $user = User::factory()->isAdmin()->create();
        $company = Company::factory()->make()->toArray();
        unset($company['ratings']);
        $this->assertDatabaseMissing('companies', $company);

        $response = $this->actingAs($user)->postJson(route('companies.store'), $company);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('companies', $company);
    }

    public function test_non_admin_can_not_store_a_new_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->make()->toArray();
        unset($company['ratings']);
        $this->assertDatabaseMissing('companies', $company);

        $response = $this->actingAs($user)->postJson(route('companies.store'), $company);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('companies', $company);
    }

    public function test_admin_can_update_a_company()
    {
        $user = User::factory()->isAdmin()->create();
        $oldCompany = Company::factory()->create()->toArray();
        unset($oldCompany['ratings']);
        unset($oldCompany['updated_at']);
        unset($oldCompany['created_at']);
        $newCompany = Company::factory()->make()->toArray();
        unset($newCompany['ratings']);

        $this->assertDatabaseHas('companies', $oldCompany);
        $this->assertDatabaseMissing('companies', $newCompany);

        $response = $this->actingAs($user)->patchJson(route('companies.update', $oldCompany['id']), $newCompany);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('companies', $newCompany);
        $this->assertDatabaseMissing('companies', $oldCompany);
    }

    public function test_non_admin_can_not_update_a_company()
    {
        $user = User::factory()->create();
        $oldCompany = Company::factory()->create()->toArray();
        unset($oldCompany['ratings']);
        unset($oldCompany['updated_at']);
        unset($oldCompany['created_at']);
        $newCompany = Company::factory()->make()->toArray();
        unset($newCompany['ratings']);

        $this->assertDatabaseHas('companies', $oldCompany);
        $this->assertDatabaseMissing('companies', $newCompany);

        $response = $this->actingAs($user)->patchJson(route('companies.update', $oldCompany['id']), $newCompany);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertDatabaseMissing('companies', $newCompany);
        $this->assertDatabaseHas('companies', $oldCompany);
    }

    public function test_admin_can_delete_a_company()
    {
        $user = User::factory()->isAdmin()->create();
        $company = Company::factory()->create()->toArray();
        unset($company['ratings']);
        unset($company['updated_at']);
        unset($company['created_at']);

        $this->assertDatabaseHas('companies', $company);

        $response = $this->actingAs($user)->deleteJson(route('companies.destroy', $company['id']));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('companies', $company);
    }

    public function test_non_admin_can_not_delete_a_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create()->toArray();
        unset($company['ratings']);
        unset($company['updated_at']);
        unset($company['created_at']);

        $this->assertDatabaseHas('companies', $company);

        $response = $this->actingAs($user)->deleteJson(route('companies.destroy', $company['id']));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertDatabaseHas('companies', $company);
    }
}
