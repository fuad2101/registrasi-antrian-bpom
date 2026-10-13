<?php

use Livewire\Component;
use App\Models\Antrian;

new #[Layout('layouts::app')] class extends Component
{

    public $items = [];
    public $antrian = null;

    public function mount()
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }

        $this->items = App\Models\Antrian::all();

    }
    public function edit($id)
    {
        $this->antrian = Antrian::findOrFail($id);
        
        // dd($this->antrian);
    }
};
?>

<div>
    <x-wirekit::table>
        <x-wirekit::table.head>
            <x-wirekit::table.row>
                <x-wirekit::table.th>No. Antrian</x-wirekit::table.th>
                <x-wirekit::table.th>Status</x-wirekit::table.th>
                <x-wirekit::table.th align="right">Deskripsi</x-wirekit::table.th>
                <x-wirekit::table.th align="right">Jenis Layanan</x-wirekit::table.th>
                <x-wirekit::table.th align="right">Aksi</x-wirekit::table.th>
            </x-wirekit::table.row>
        </x-wirekit::table.head>
        <x-wirekit::table.body>
            @foreach ($items as $item)
            <x-wirekit::table.row>
                <x-wirekit::table.td>{{ $item->nomor_antrian }}</x-wirekit::table.td>
                <x-wirekit::table.td>{{ $item->status }}</x-wirekit::table.td>
                <x-wirekit::table.td align="right">{{ $item->deskripsi }}</x-wirekit::table.td>
                <x-wirekit::table.td align="right">{{ $item->jenis_layanan }}</x-wirekit::table.td>
                <x-wirekit::table.td align="right">
                     <x-wirekit::modal.trigger for="edit-user" wire:click="edit({{ $item->id }})">Edit Modal</x-wirekit::modal.trigger>
                </x-wirekit::table.td>
            </x-wirekit::table.row>
            @endforeach
        </x-wirekit::table.body>
    </x-wirekit::table>


    {{-- Modal --}}
    <x-wirekit::modal name="edit-user" wire:model.live="antrian" size="lg">
        <x-wirekit::modal.header>Edit User</x-wirekit::modal.header>
        <x-wirekit::modal.body>
            {{-- Form Modal --}}
            @if ($antrian !== null)
                <x-wirekit::form wire:submit.prevent="save">
                    <x-wirekit::stack>
                        <x-wirekit::label for="nomor_antrian">Nomor Antrian</x-wirekit::label>
                        <x-wirekit::input id="nomor_antrian" value="{{ $antrian->nomor_antrian }}" />
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::label for="status">Status</x-wirekit::label>
                        <x-wirekit::input id="status" value="{{ $antrian->status }}"/>
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::label for="deskripsi">Deskripsi</x-wirekit::label>
                        <x-wirekit::input id="deskripsi" value="{{ $antrian->deskripsi }}" />
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::label for="jenis_layanan">Jenis Layanan</x-wirekit::label>
                        <x-wirekit::input id="jenis_layanan" value="{{ $antrian->jenis_layanan }}"/>
                    </x-wirekit::stack>
                </x-wirekit::form>
            @endif
        </x-wirekit::modal.body>
        <x-wirekit::modal.footer>
            <x-wirekit::modal.close>
                <x-wirekit::button intent="neutral" surface="ghost">Cancel</x-wirekit::button>
            </x-wirekit::modal.close>
            <x-wirekit::button wire:click="save">Save</x-wirekit::button>
        </x-wirekit::modal.footer>
    </x-wirekit::modal>
    




</div>
