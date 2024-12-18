<?php

namespace Tests\Feature;

use App\Models\FamilyHead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyHeadControllerTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_a_list_of_family_heads_with_member_counts()
    {
        FamilyHead::factory()->count(10)->create();

        $response = $this->get(route('family.head.index'));

        $response->assertStatus(200);
        $response->assertViewIs('family.index');
        $response->assertViewHas('familyHeads');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_displays_the_create_family_head_form()
    {
        $response = $this->get(route('family.head.create'));

        $response->assertStatus(200);
        $response->assertViewIs('family.create_head');
        $response->assertViewHas('statesAndCities');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_stores_a_new_family_head()
    {
        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'birth_date' => '1980-01-01',
            'mobile_no' => '1234567890',
            'address' => '123 Street',
            'state' => 'Maharashtra',
            'city' => 'Mumbai',
            'pincode' => '400001',
            'marital_status' => 'Married',
            'wedding_date' => '2000-01-01',
            'hobbies' => ['reading', 'traveling'],
            'photo' => null, // Assume no photo for simplicity
        ];

        $response = $this->post(route('family.head.store'), $data);

        $this->assertDatabaseHas('family_heads', [
            'name' => 'John',
            'surname' => 'Doe',
        ]);

        $response->assertRedirect(route('family.head.create'));
        $response->assertSessionHas('success', 'Family head added successfully.');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_add_demo_family_members()
    {
        $familyHead = FamilyHead::factory()->create();
        $familyHead->familyMembers()->createMany([
          
            ['name' => 'Member 2','family_head_id'=>1, 'm_birth_date'=>'10-07-1990','education'=>'MA','marital_status'=>'unmarried', 'wedding_date'=>null, 'photo'=>null],
            ['name' => 'Member 2','family_head_id'=>1,'m_birth_date'=>'10-07-1990','education'=>'BA','marital_status'=>'married', 'wedding_date'=>'15-05-2016', 'photo'=>null],
        ]);

        $response = $this->get(route('family.head.show', $familyHead->id));

        $response->assertStatus(200);
        $response->assertViewIs('family.show');
        $response->assertViewHas(['familyHead', 'familyMembers']);
    }
 
}
