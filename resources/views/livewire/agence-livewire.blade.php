<div>
    {{-- Because she competes with no one, no one can compete with her. --}}


	<!-- Button trigger modal -->

<!-- Modal -->
@if(false)
<div>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="modal-formLabel">Nouvelle Agence</h5>
        <button type="button" class="close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" wire:submit.prevent="saveAgence">

      	<div class="modal-body">
        	<div class="form-group">
        		<label for="">NOM DE L'AGENCE</label>
        		<input type="text" wire:model="name" class="form-control">
        		@error("name")
        		<p class="error text-danger">{{$message}}</p>
        		@enderror
        	</div>
        	<div class="form-group">
        		<label for="">DESCRIPTION</label>
        		 <textarea class="form-control" wire:model="description"></textarea>
        	</div>
      </div>
      
        <button type="submit" class="btn btn-primary">Enregistrer</button>
 
    
      </form>
    </div>
  </div>
</div>

@endif

 

 <table class="table">
 	<thead>
 		<tr>
 			<th>AGENCE</th>
 			<th>DESCRIPTION</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach ($agences as $element)
 	{{-- expr --}}
		 	<tr>
		 		<td>{{$element->name}}</td>
		 		<td>{{$element->description}}</td>
		 	</tr>
    @endforeach
 	</tbody>
 </table>
</div>
