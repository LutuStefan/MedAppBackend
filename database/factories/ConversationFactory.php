<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition()
    {
        // Randomly select two different users to create a conversation
        $userOne = User::inRandomOrder()->where('role_id', 1)->first();
        $userTwo = User::inRandomOrder()->where('role_id', 2)->first();

        return [
            'user_one_id' => $userOne->id,
            'user_two_id' => $userTwo->id,
        ];
    }
}
