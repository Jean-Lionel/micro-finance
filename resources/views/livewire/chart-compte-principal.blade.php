<div>
	{{-- MONTANT DU COMPTE PRINCIPALE : <b># {{$value ?? ''}}</b> FBU --}}
	<style>
		.test{
			/*background: rgb(212,175,55);*/
			background: #b0a1a5;
			box-shadow: 5px 10px #888888 
		}
		.test:hover {
			/*background: rgb(255,223,0);*/
			background: #acce6d;
			cursor: pointer;
			box-shadow: 5px 10px rgb(7,179,88);
		}
	</style>
	<div class="row p-2">
		<div class="col-md-4">
			<div class="col-xl-12 col-sm-12">
	
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">MONTANT DU COMPTE</p>
							<h5 class="mb-0 number-font"># {{numberFormat($value) ?? ''}} FBU</h5> 
						</div> 
						<div class="col-auto mb-0"> 
							<div class="dash-icon"> 

								<i class="fa fa-money fa-3x"></i>
							</div> 
						</div> 
					</div> 

				</div> 

			</div>
		</div>

		<div class="col-md-4">

			<div class="col-xl-12 col-sm-12">
			
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">CAISSE KINAMA</p>
							<h5 class="mb-0 number-font"># {{numberFormat($agences[0]->montant) ?? ''}} FBU</h5> 
						</div> 
						<div class="col-auto mb-0"> 
							<div class="dash-icon"> 

								<i class="fa fa-money fa-3x"></i>
							</div> 
						</div> 
					</div> 
				</div> 
			</div>
		</div>

		<div class="col-md-4">
			
			<div class="col-xl-12 col-sm-12">
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">CAISSE RUBIRIZI</p>
							<h5 class="mb-0 number-font"># {{numberFormat($agences[1]->montant) ?? ''}} FBU</h5> 
						</div> 
						<div class="col-auto mb-0"> 
							<div class="dash-icon"> 

								<i class="fa fa-money fa-3x"></i>
							</div> 
						</div> 
					</div> 

				</div> 

			</div>
		</div>
	</div>
	<div class="row mt-2 mb-3">
		<div class="col-md-4">
			<div class="col-xl-12 col-sm-12">
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">CAISSE RUGAZI</p>
							<h5 class="mb-0 number-font"># {{numberFormat($agences[2]->montant) ?? ''}} FBU</h5> 
						</div> 	
					</div> 
				</div> 

			</div>
		</div>	
		<div class="col-md-4">
			<div class="col-xl-12 col-sm-12">
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">CAISSE MUYIRA</p>
							<h5 class="mb-0 number-font"># {{numberFormat($agences[3]->montant) ?? ''}} FBU</h5> 
						</div> 	
					</div> 
				</div> 
			</div>
		</div>	
			<div class="col-md-4">
			<div class="col-xl-12 col-sm-12">
				<div class="card-body test border-danger" >
					<div class="row mb-1"> 
						<div class="col"> 
							<p class="mb-1">CAISSE RUYAGA </p>
							<h5 class="mb-0 number-font"># {{numberFormat($agences[4]->montant) ?? ''}} FBU</h5> 
						</div> 	
					</div> 
				</div> 

			</div>
		</div>	
		
	</div>

</div>


