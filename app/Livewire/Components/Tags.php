<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Tags extends Component
{
    // public $tags = [];
    // public function __construct(
    //   public $tags = []
    // ){
    //     //
    // }
    public array $tags;

    /**
     * mount.
     *
     * @param array $tags
     * @return void
     */
    public function mount(?array $tags = []): void
    {
        $this->tags = $tags;
    }

    /**
     * change tags.
     *
     * @param string $tags
     * @return void
     */
    public function changeTags(string $tags): void
    {
        if (empty($tags)) {
            return;
        }
        $changed = collect(json_decode($tags))->pluck('value')->toArray();

        // $this->emitUp('changeTags', $changed);
        $this->dispatch('refresh',$changed);
    }
    public function updateTags($newTags)
    {
    $this->tags = $newTags;
    }


   
    // public function render()
    // {
    //     $this->tags = $this->tags ?: Tag::all()->pluck('name')->toArray();

    //     return view('livewire.tagify', [
    //         'tags' => $this->tags,
    //     ]);
    // }
    public function render()
    {
        // $this->tags = $this->tags ?: Tag::all()->pluck('name')->toArray();
        return view('livewire.components.tags');
    }
}
