<div>
    {{-- The whole world belongs to you --}}

    <div>
        <div class="mb-2">
              <input type="text" wire:model="periode" class="form-control form-control-sm">
        </div>

        <div>
            <button wire:click="augmenterPeriode" class="btn-primary" style="cursor:pointer">Augmenter la periode </button>
        <button class="btn-warning pointer" style="cursor:pointer">Diminuer la periode</button>
        </div>
      
        
    </div>
</div>
