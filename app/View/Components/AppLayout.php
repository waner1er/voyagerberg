<?php

namespace App\View\Components;

use Illuminate\View\Component;
use TCG\Voyager\Models\Post;

class AppLayout extends Component
{
//    public Post $post;
//    /**
//     * Create a new component instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->post = Post::first();
//    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app-layout');
    }
}
