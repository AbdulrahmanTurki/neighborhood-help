<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\HelpRequest;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Skill; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    
    use WithoutModelEvents; 

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = User::create([
            'name' => 'Admin Moderator',
            'email' => 'admin@helpout.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        $user_alice = User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user_bob = User::create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        
        
        Profile::create([
            'user_id' => $admin->id,
            'bio' => 'Platform administrator and community manager. Ready to help with moderation and technical issues.',
            'location' => 'Central Hub, Sector 1',
        ]);

        Profile::create([
            'user_id' => $user_alice->id,
            'bio' => 'Local resident offering math and science tutoring. Love to help my neighbors succeed!',
            'location' => 'North Side, Elm Street',
        ]);

        Profile::create([
            'user_id' => $user_bob->id,
            'bio' => 'Handyman and pet lover. Always happy to lend a strong back or a leash.',
            'location' => 'South End, Oak Avenue',
        ]);


        
        $category_moving = Category::create(['name' => 'Moving & Lifting']);
        $category_pets = Category::create(['name' => 'Pet Care']);
        $category_tutoring = Category::create(['name' => 'Education & Tutoring']);
        $category_chores = Category::create(['name' => 'Yard Work & Chores']);
        
       
        $request_moving = HelpRequest::create([
            'user_id' => $user_alice->id,
            'category_id' => $category_moving->id,
            'title' => 'Can anyone help me move boxes this weekend?',
            'body' => 'Need 2 people for about 3 hours on Saturday morning (Oct 4th) to move some heavy book boxes from the first floor to the garage. Will pay $20/hr per person.',
            'type' => 'request',
            'status' => 'open',
        ]);

       
        $offer_tutoring = HelpRequest::create([
            'user_id' => $user_bob->id,
            'category_id' => $category_tutoring->id,
            'title' => 'Offering free tutoring for high school math.',
            'body' => 'I have a Masters in Applied Mathematics and would love to help high school students with Algebra or Calculus. Totally free, just need a quiet place to meet.',
            'type' => 'offer',
            'status' => 'open',
        ]);
        
        
        $request_pet_care = HelpRequest::create([
            'user_id' => $user_alice->id,
            'category_id' => $category_pets->id,
            'title' => 'Need someone to walk my dog while I’m away.',
            'body' => 'Leaving town next week (Oct 6-10). Need two walks per day for a medium-sized golden retriever. He is very friendly!',
            'type' => 'request',
            'status' => 'in_progress',
        ]);
        
        
        Comment::create([
            'user_id' => $user_bob->id, 
            'help_request_id' => $request_pet_care->id,
            'body' => 'I\'d love to help out with your golden retriever! I live right on Oak Avenue and can easily do 8 am and 5 pm walks. Let me know if you are interested!',
        ]);

        Comment::create([
            'user_id' => $admin->id, 
            'help_request_id' => $request_pet_care->id,
            'body' => 'Great to see neighbors helping neighbors! This is what HelpOut is all about.',
        ]);
    
        $skill_plumbing = Skill::create(['name' => 'Basic Plumbing']); 
        $skill_dog_walking = Skill::create(['name' => 'Dog Walking']);
        $skill_math_tutoring = Skill::create(['name' => 'Math Tutoring']);
        $skill_heavy_lifting = Skill::create(['name' => 'Heavy Lifting']);
        $skill_tech_support = Skill::create(['name' => 'Technical Support']);

       
        $additional_skills = collect([
            Skill::create(['name' => 'Light Carpentry']),
            Skill::create(['name' => 'Gardening/Lawn Care']),
            Skill::create(['name' => 'Babysitting']),
            Skill::create(['name' => 'Home Repairs']),
            Skill::create(['name' => 'Errands Runner']),
        ]);

        
        $all_skills = collect([
            $skill_plumbing,
            $skill_dog_walking,
            $skill_math_tutoring,
            $skill_heavy_lifting,
            $skill_tech_support,
        ])->merge($additional_skills); 

        $user_alice->skills()->attach($skill_math_tutoring);
        $user_alice->skills()->attach($skill_heavy_lifting);
        
        $user_bob->skills()->attach($skill_dog_walking);
        $user_bob->skills()->attach($skill_heavy_lifting);
        $user_bob->skills()->attach($skill_plumbing);
        
        $admin->skills()->attach($skill_tech_support);
        
        // Using Factories.
        User::factory(50)
            ->has(Profile::factory())
            
            ->hasAttached(
                $all_skills->random(rand(0, $all_skills->count())), 
                function () {
                    return []; 
                },
                'skills' 
            )
            ->create();
        
        

        Category::factory(5)->create();

        HelpRequest::factory(20)
            ->has(Comment::factory(rand(1, 5)))
            ->create();
            

    }
}