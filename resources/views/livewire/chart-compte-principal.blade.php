<div>
	
	{{-- MONTANT DU COMPTE PRINCIPALE : <b># {{$value ?? ''}}</b> FBU --}}

	<div class="row p-2">
		<div class="col-xl-12 col-sm-12">
			<style>
				.test{
					
					/*background: rgb(212,175,55);*/
					background: #b0a160;
					box-shadow: 5px 10px #888888 
				}
				.test:hover {
					/*background: rgb(255,223,0);*/
					background: #ecce6d;
					cursor: pointer;
					box-shadow: 5px 10px rgb(197,179,88);

				}
				
			</style>
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
				{{-- <span class="fs-12 text-muted"> 
					<strong>2.6%</strong>
					<i class="mdi mdi-arrow-up"></i> 
					<span class="text-muted fs-12 ml-0 mt-1">than last week</span>
				</span> --}}

			</div> 
			
		</div>


		
	</div>

</div>


