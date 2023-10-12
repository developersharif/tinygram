<?php
use App\Models\Post;
use App\Models\User;

describe("Delete a post",function(){
    it("should delete post associated with post owner",function(){
        // Create a user using the User factory.
        $user = User::factory()->create();
        // Create a post associated with the user.
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->delete("/post/{$post->id}");
        $response->assertValid();
        $response->assertRedirect();
    });


    it("should not delete post",function(){
        // Create a user using the User factory.
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        // Create a post associated with the user.
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user2)->delete("/post/{$post->id}");
        $response->assertStatus(403);
    });

});
