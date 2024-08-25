<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $existingConversation = Conversation::where('user_one_id', $user->id)
                ->orWhere('user_two_id', $user->id)
                ->first();

            if (!$existingConversation) {
                $otherUser = User::where('id', '!=', $user->id)
                    ->whereDoesntHave('conversations', function ($query) use ($user) {
                        $query->where('user_one_id', $user->id)
                            ->orWhere('user_two_id', $user->id);
                    })
                    ->inRandomOrder()
                    ->first();

                if ($otherUser) {
                    Conversation::create([
                        'user_one_id' => $user->id,
                        'user_two_id' => $otherUser->id,
                    ]);
                }
            }
        }

        // Optionally, add more random conversations
        Conversation::factory()->count(50)->create();
    }
}
