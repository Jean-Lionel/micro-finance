<div>
    {{-- The whole world belongs to you --}}

    <div>
        <div class="mb-2">
              <input type="text" wire:model="periode" class="form-control form-control-sm">
              @error('periode')
              <p class="text-danger">{{$message}}</p>
              @enderror
              @error('action')
              <p class="text-danger">{{$message}}</p>
              @enderror
        </div>

        <div class="d-flex">
            <select wire:model="action" class="form-control-sm">
                <option value=""></option>
                <option value="+">(+) Augmenter </option>
                <option value="-">(-) Diminuer</option>
            </select>
            <button wire:click="augmenterPeriode" class="btn-primary" style="cursor:pointer">Valider </button>
        </div>
      
        
    </div>
</div>
