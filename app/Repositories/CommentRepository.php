<?php
namespace App\Repositories;
use App\Models\Comment;
class CommentRepository{

    function create(array $data){
        try {
            return Comment::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function findById(int $id){
        try {
            return Comment::find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function destroy(Comment $comment){
        try {
            return $comment->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}