<div>
    {{-- Success is as dangerous as failure. --}}




  

  <div class="grey-bg container-fluid">
  <section id="minimal-statistics">
  
    
  
   
  </section>
  
  <section id="stats-subtitle">
  <div class="row">
    <div class="col-12 mt-3 mb-1">
      <h4 class="text-uppercase">LES OPERATIONS EFFECTUER</h4>

    </div>
  </div>

  <div class="row">
    <div class="col-xl-6 col-md-12">
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
                <h1>{{ number_format($montantKirimba) }} # FBU</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <i class="icon-speech warning font-large-2 mr-2"></i>
              </div>
              <div class="media-body">
                <h4>Total des Membres</h4>
                <span>COOPDI</span>
              </div>
              <div class="align-self-center"> 
                <h1>{{ $membreTotal }} Personnes</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6 col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <h1 class="mr-2">{{ number_format($versement) }} FBU</h1>
              </div>
              <div class="media-body">
                <h4>Total Des Versements</h4>
                <span> {{ date('D/M/Y') }}</span>
              </div>
              <div class="align-self-center">
                <i class="icon-heart danger font-large-2"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-content">
          <div class="card-body cleartfix">
            <div class="media align-items-stretch">
              <div class="align-self-center">
                <h1 class="mr-2">{{ number_format($retrait) }} # FBU</h1>
              </div>
              <div class="media-body">
                <h4>Total Des Retraits</h4>
                <span> {{ date('D/M/Y') }}</span>
              </div>
              <div class="align-self-center">
                <i class="icon-heart danger font-large-2"></i>
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
      	</div>

      	<div class="card-body">
      	

      		 <ul>
      		 
      		 @foreach($user_operations as $op)
    

      		 <li>{{ $op->user_id }} - {{ $op->type_operation }} - {{ $op->sum_montant }} </li>
      		 @endforeach 	

      		  </ul> 	
      	</div>
       
      </div>
    </div>
  </div>
</section>
</div>
</div>
