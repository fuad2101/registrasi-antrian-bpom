<?php

use Livewire\Component;
use App\Models\Antrian;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

new #[Layout('layouts::app')] class extends Component
{

    public $items = [];
    public $antrian = null;
    public $status = '';

    public function mount()
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        $this->items = App\Models\Antrian::all();

        if ($message = session('success')) {
            $this->dispatch(
                'wirekit-toast',
                variant: 'success',
                title: 'Saved',
                message: $message,
            );
        }
    }
    public function edit($id)
    {
        $this->antrian = Antrian::findOrFail($id);
    }

    public function save(Request $request)
    {
        $antrian = Antrian::findOrFail($this->antrian->id);
        $antrian->status = $this->status;
        $antrian->save();


        return redirect()->route('antrian.update')->with('success', 'Sukses mengupdate antrian');
    }

    public function call()
    {
        
    }
};
?>

<div>
    <x-wirekit::container>
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
                    <x-wirekit::table.td>
                        <x-wirekit::badge
                            :intent="['menunggu' => 'warning', 'dipanggil' => 'info', 'selesai' => 'success'][$item->status] ?? 'neutral'"
                            size="sm"
                        >
                            {{ $item->status }}
                        </x-wirekit::badge>
                    </x-wirekit::table.td>
                    <x-wirekit::table.td align="right">{{ $item->deskripsi }}</x-wirekit::table.td>
                    <x-wirekit::table.td align="right">{{ $item->layanans_id }}</x-wirekit::table.td>
                    <x-wirekit::table.td align="right">
                        <x-wirekit::modal.trigger for="edit-user" icon="pencil" wire:click="edit({{ $item->id }})"><x-wirekit::icon size="sm" name="pencil" /></x-wirekit::modal.trigger>
                         <x-wirekit::button size="sm" intent="danger" surface="outline" icon-only>
                            <x-slot:iconLeft><x-wirekit::icon name="megaphone" size="sm" aria-hidden="true" /></x-slot:iconLeft>
                            Delete user
                        </x-wirekit::button>
                    </x-wirekit::table.td>
                </x-wirekit::table.row>
                @endforeach
            </x-wirekit::table.body>
        </x-wirekit::table>
    </x-wirekit::container>


    {{-- Modal --}}
    <x-wirekit::modal name="edit-user" wire:model.live="antrian" size="lg">
        <x-wirekit::modal.header>Edit Antrian</x-wirekit::modal.header>

        <x-wirekit::modal.body>
            {{-- Form Modal --}}
            @if ($antrian !== null)
                <x-wirekit::form >
                    <x-wirekit::stack>
                        <x-wirekit::label for="nomor_antrian">Nomor Antrian</x-wirekit::label>
                        <x-wirekit::input id="nomor_antrian" disabled value="{{ $antrian->nomor_antrian }}" />
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::label for="jenis_layanan">Jenis Layanan</x-wirekit::label>
                        <x-wirekit::input id="jenis_layanan" disabled value="{{ $antrian->layanans_id }}"/>
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::label for="deskripsi">Deskripsi</x-wirekit::label>
                        <x-wirekit::input id="deskripsi" disabled value="{{ $antrian->deskripsi }}" />
                    </x-wirekit::stack>

                    <x-wirekit::stack>
                        <x-wirekit::select
                            wire:model="status"
                            id="status"
                            label="Status"
                            name="status"
                            placeholder="Choose a status..."
                            :options="['menunggu' => 'menunggu', 'dipanggil' => 'dipanggil', 'selesai' => 'selesai']"
                        />
                    </x-wirekit::stack>
                </x-wirekit::form>
            @endif
        </x-wirekit::modal.body>

        <x-wirekit::modal.footer>
            <x-wirekit::modal.close>
                <x-wirekit::button intent="neutral" surface="ghost">Cancel</x-wirekit::button>
            </x-wirekit::modal.close>
            <x-wirekit::button wire:click="save">Update</x-wirekit::button>
        </x-wirekit::modal.footer>
    </x-wirekit::modal>





</div>
