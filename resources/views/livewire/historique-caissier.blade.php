<div>
    {{-- The whole world belongs to you --}}

    <div>
        <h5 class="text-center">{{$caisse->user->first_name }} {{$caisse->user->last_name }} </h5>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>DATE</th>
                <th>TYPE</th>
                <th>MONTANT ( #FBU)</th>
            </tr>
            
        </thead>

        <tbody>
            
            @foreach ($operations as $element)
                <tr>
                    <td>{{ $element->created_at }}</td>
                    <td>{{ $element->type_operation == 'VIREMENT MATINAL' ? 'APPROVISIONEMENT' : 'RETOUR' }}</td>
                    <td class="text-left">{{ number_format($element->montant) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $operations->links()}}
</div>
