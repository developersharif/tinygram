<?php
namespace App\Repositories;
use App\Models\User;
class UserRepository{

    function create(array $data){
        try {
            return User::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function findById(int $id){
        try {
            return User::find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    function destroy(User $user){
        try {
            return $user->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function searchUser(string $searchKey){
        try {
            return User::where('name','like',"%$searchKey%")->orWhere('email','like',"%$searchKey%")->limit(45)->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}