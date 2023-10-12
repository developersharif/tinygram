<?php
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
describe("Authedticated User can create new post",function(){
    it("should create new post",function(){
        Storage::fake('photo');
        $file = UploadedFile::fake()->image('photoOne.jpg');
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post("/post",[
            "user_id"=>$user->id,
            "body" => fake()->text(),
            "photo" => $file,
            "comment_status"=> 1,
            "status"=>1
        ]);
        $response->assertValid();
        $response->assertRedirect();
    });
});
