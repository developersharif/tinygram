<?php
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
/**
 * Test the ability of an authenticated user to update a post.
 */
describe("Authedticated User can update a post",function(){
    /**
     * It should update a post.
     */
    it("should update a post",function(){
        // Use Laravel's built-in Storage fake for testing.
        Storage::fake('photo');
        // Create a fake image file.
        $file = UploadedFile::fake()->image('photoTwo.jpg');
        // Create a user using the User factory.
        $user = User::factory()->create();
        // Create a post associated with the user.
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);
        // dump($post);
        // Act as the authenticated user and send a PUT request to update the post.
        $response = $this->actingAs($user)->put("/post/{$post->id}",[
            "body" => "updated",
            "photo" => $file,
            "comment_status"=> 0,
            "status"=>1
        ]);
        // dump(Post::find($post->id));
         // Assert that the response is valid.
        $response->assertValid();
         // Assert that the response redirects to the expected location.
        $response->assertRedirect();
    });
});