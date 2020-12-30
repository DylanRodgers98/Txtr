<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;

class PostComponent extends Component
{
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.post', ['post' => $this->post]);
    }
}
