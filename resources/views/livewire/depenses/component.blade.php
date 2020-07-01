<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
     @endif

    @if(count($errors) > 0)
    <div class="alert alert-danger">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<strong>Ohhh!!!</strong> Entre invalide. <br><br>
    	<ul class="list-style-type:none">
    		@foreach($errors->all() as $error)
    		 <li>{{$error}}</li>
    		@endforeach
    	</ul>
    </div>

    @endif

    @if($update_mode)
    	@include('livewire.depenses.update')
    @else
    	@include('livewire.depenses.create')
    @endif

    <table class="table table-bordered table-striped">
    	<tr>
    		<th>ID</th>
    		<th>@sortablelink('action_name')</th>
    		<th>MONTANT</th>
    		<th>ACTION</th>
    	</tr>

    	@foreach($data as $row)
    	<tr>
    		<td>{{ $row->id }}</td>
    		<td>{{ $row->action_name }}</td>
    		<td>{{ $row->montant }}</td>

    		<td>
              
    			<button wire:click="edit({{ $row->id}})" class="btn btn-xs btn-warning">Modifier</button>
    			<button wire:click="destroy({{$row->id}})"
    				class="btn-xs btn-danger">Supprime</button>
    		</td>
    	</tr>

    	@endforeach
    </table>
    {{ $data->links() }}

</div>
