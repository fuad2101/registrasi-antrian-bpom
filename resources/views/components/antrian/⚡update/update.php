<?php

use Livewire\Component;

new class extends Component
{

    public function mount()
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        
    }
};
