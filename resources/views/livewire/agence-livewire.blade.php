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
 <div class="row">
  @foreach ($agences as $agence)
    <div class="col-md-4">
        <h5>AGENCE : {{$agence->name}}</h5>
        <h6>LISTE DES CAISSIERS</h6>
        <hr>
        <table class="table tab-content table-hover">
          <tr>
            <th>#</th>
            <th>NOM ET PRENOM</th>
            {{-- <th>ROLES</th> --}}
          </tr>
          @foreach ($agence->users as $key => $user)
            {{-- expr --}}
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $user->first_name}} {{ $user->last_name}}</td>
             {{--   <td>
                
                 @foreach ( $user->roles  as $role)
                  
                    <span>{{$role->name}}</span> | 
                  @endforeach
                 

              </td>--}}
            </tr>
          @endforeach
        </table>
    </div>

  @endforeach

  
 </div>
</div>
