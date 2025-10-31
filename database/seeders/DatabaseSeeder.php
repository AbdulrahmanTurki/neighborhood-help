<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\HelpRequest;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Skill; // Added import for Skill model
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    // Important: Use WithoutModelEvents to prevent unwanted side effects if listeners are present.
    use WithoutModelEvents; 

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'Admin Moderator',
            'email' => 'admin@helpout.com',
            'password' => Hash::make('password'), // You should change this password immediately in a real app
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
        
        // 2. Create Profiles
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


        // 3. Create Categories
        $category_moving = Category::create(['name' => 'Moving & Lifting']);
        $category_pets = Category::create(['name' => 'Pet Care']);
        $category_tutoring = Category::create(['name' => 'Education & Tutoring']);
        $category_chores = Category::create(['name' => 'Yard Work & Chores']);
        
        // 4. Create Help Requests (Posts)
        
        // Post 1 (Request - from Alice)
        $request_moving = HelpRequest::create([
            'user_id' => $user_alice->id,
            'category_id' => $category_moving->id,
            'title' => 'Can anyone help me move boxes this weekend?',
            'body' => 'Need 2 people for about 3 hours on Saturday morning (Oct 4th) to move some heavy book boxes from the first floor to the garage. Will pay $20/hr per person.',
            'type' => 'request',
            'status' => 'open',
        ]);

        // Post 2 (Offer - from Bob)
        $offer_tutoring = HelpRequest::create([
            'user_id' => $user_bob->id,
            'category_id' => $category_tutoring->id,
            'title' => 'Offering free tutoring for high school math.',
            'body' => 'I have a Masters in Applied Mathematics and would love to help high school students with Algebra or Calculus. Totally free, just need a quiet place to meet.',
            'type' => 'offer',
            'status' => 'open',
        ]);
        
        // Post 3 (Request - from Alice, with a comment)
        $request_pet_care = HelpRequest::create([
            'user_id' => $user_alice->id,
            'category_id' => $category_pets->id,
            'title' => 'Need someone to walk my dog while I’m away.',
            'body' => 'Leaving town next week (Oct 6-10). Need two walks per day for a medium-sized golden retriever. He is very friendly!',
            'type' => 'request',
            'status' => 'in_progress',
        ]);
        
        // 5. Create Comments on the Pet Care post
        Comment::create([
            'user_id' => $user_bob->id, // Bob comments on Alice's post
            'help_request_id' => $request_pet_care->id,
            'body' => 'I\'d love to help out with your golden retriever! I live right on Oak Avenue and can easily do 8 am and 5 pm walks. Let me know if you are interested!',
        ]);

        Comment::create([
            'user_id' => $admin->id, // Admin comments (just showing visibility/use case)
            'help_request_id' => $request_pet_care->id,
            'body' => 'Great to see neighbors helping neighbors! This is what HelpOut is all about.',
        ]);
    
        // 6. Create Skills and attach to users <--- NEW LOGIC START
        $skill_plumbing = Skill::firstOrCreate(['name' => 'Basic Plumbing']);
        $skill_dog_walking = Skill::firstOrCreate(['name' => 'Dog Walking']);
        $skill_math_tutoring = Skill::firstOrCreate(['name' => 'Math Tutoring']);
        $skill_heavy_lifting = Skill::firstOrCreate(['name' => 'Heavy Lifting']);
        $skill_tech_support = Skill::firstOrCreate(['name' => 'Technical Support']);

        $user_alice->skills()->attach($skill_math_tutoring);
        $user_alice->skills()->attach($skill_heavy_lifting);
        
        $user_bob->skills()->attach($skill_dog_walking);
        $user_bob->skills()->attach($skill_heavy_lifting);
        $user_bob->skills()->attach($skill_plumbing);
        
        $admin->skills()->attach($skill_tech_support); // Admin has tech skills
        
        // Also create an additional 5 random skills to populate the table further
        Skill::factory(5)->create();

        // Using Factories.
        User::factory(50)
            ->has(Profile::factory())
            // Attach between 0 and 3 skills to random users from all available skills
            ->hasAttached(
                Skill::inRandomOrder()->limit(rand(0, 3)),
                function () {
                    return []; // No extra pivot data needed
                },
                'skills' // The relationship name on the User model
            )
            ->create();
        // <--- NEW LOGIC END

        Category::factory(5)->create();

        HelpRequest::factory(20)
            ->has(Comment::factory(rand(1, 5)))
            ->create();
            

    }
}