<div class="mt-4">
    {{-- Success is as dangerous as failure. --}}

  <div class="grey-bg container-fluid">
    <h5 class="text-center"> Rapport </h5>
  <section id="stats-subtitle">

  <div class="row">
    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="d-flex">
               <div class="media-body">
                <h4>Total Des Versements</h4>
                <span> {{ date('d-M-Y') }}</span>
              </div>
              <div>
                 <h5 class="mr-2">{{ number_format($versement) }} FBU</h5>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-content">
          <div class="card-body ">

             <div class="d-flex">
               <div class="media-body">
                 <h4>Total Des Retraits</h4>
                <span> {{ date('d-M-Y') }}</span>
              </div>
              <div>
                 <h5 class="mr-2">{{ number_format($retrait) }} FBU</h5>
              </div>
            </div>

          </div>
        </div>
      </div>

       <div class="card overflow-hidden">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <i class="icon-pencil primary font-large-2 mr-2"></i>
              </div>
              <div class="media-body">
                <h4>MONTANT TOTAL DES EPARGNES</h4>
                <span>{{ date('d-M-Y') }}</span>
              </div>
              <div class="align-self-center">
                <h5>{{ number_format($montantKirimba) }} # FBU</h5>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="card">
         <div class="card-content">
          <div class="card-body ">
             <div class="d-flex">
               <div class="media-body">
                 <h4>Total des Membres</h4>
                <span>COOPDI</span>
              </div>
              <div>
                   <h5>{{ $membreTotal }} Personnes</h5>
              </div>
            </div>
          </div>
        </div>
        
      </div>

      <div class="card">
        <div class="card-content">
          <div class="card-body">


            <div class="d-flex">
               <div class="media-body">
                 <h4>Total des Membres qui ont des dettes</h4>
                <b>{{ $membre_avec_dette->count()}} personnes</b>
              </div>
              <div>
                   <h6>Le montant en dette</h6>
                   <h5>{{ numberFormat(abs($membre_avec_dette->sum('montant')))}} # FBU</h5>
              </div>
            </div>

            
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-6 col-md-12">

      <div class="card">
      	<div class="card-title">
      		<h4 class="text-center">Rapport des Utilisateurs</h4>
          <h6 class="text-right">{{ date('d-m-Y') }}</h6>
      	</div>

      	<div class="card-body">

          <table class="table">

            <thead>
              <tr>
                <th>NOM ET PRENOM</th>
                <th>OPERATION</th>
                <th>MONTANT EN (FBU)</th>
              </tr>
            </thead>
            
            <tbody>

               @foreach($user_operations as $op)

               <tr>
                 
                 <td>{{  get_user_ById($op->user_id) }}</td>
                 <td> {{ $op->type_operation }}</td>
                 <td><b>{{ number_format($op->sum_montant) }}</b> </td>
               </tr>
    
           @endforeach 




              
            </tbody>
          </table>
      	

      			
      	</div>
       
      </div>
    </div>
  </div>
</section>
</div>
</div>
