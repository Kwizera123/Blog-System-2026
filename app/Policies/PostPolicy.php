<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
     /**
     * View post list
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

   /**
     * View a single post
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Create posts
     */
    public function create(User $user): bool
    {
        return in_array(
            $user->role,
            [
                'admin',
                'editor',
                'author'
            ]
        );
    }

    /**
     * Update posts
     */
    public function update(User $user, Post $post): bool
    {
        // Admin can update everything
        if($user->isAdmin()) {
            return true;
        }

        // Editor can update posts
         if($user->isEditor()) {
            return true;
        }

        // Author can update posts
        if ($user->isAuthor()){

        return $user->id === $post->user_id;
        }

       return false; 
    }

    /**
     * Delete posts
     */
    public function delete(User $user, Post $post): bool
    {
         // Admin can delete everything
         if ($user->isAdmin()) {
            return true;
         }

         // Author can delete only own posts
         if ($user->isAuthor()) {

            return $user->id === $post->user_id;
         }

       return false;
    }

    /**
     * Restore posts
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }

  /**
     * Permanently delete posts
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->isAdmin();
    }
}
