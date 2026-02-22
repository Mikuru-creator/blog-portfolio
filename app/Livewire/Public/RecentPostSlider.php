<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Post;

class RecentPostSlider extends Component
{
    public $posts = [];
    public int $active = 0;

    public function mount(): void
    {
        $this->posts = Post::with('images')->latest()->take(3)->get()->all();
    }

    public function next(): void
    {
        $count = count($this->posts);
        if ($count === 0) return;

        $this->active = ($this->active + 1) % $count;
    }

    public function prev(): void
    {
        $count = count($this->posts);
        if ($count === 0) return;

        $this->active = ($this->active - 1 + $count) % $count;
    }

    public function render()
    {
        return view('livewire.public.recent-post-slider');
    }
}
