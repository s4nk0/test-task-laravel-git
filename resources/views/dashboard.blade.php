@extends('layouts.app')

@section('content')
    <div class="container bg-white rounded shadow-sm my-4">
        <form class="p-4" id="uploadReceipt">
            @csrf
            <button type="submit" class="btn btn-primary">Загрузить чек</button>
        </form>
    </div>
    <div class="container bg-white rounded shadow-sm my-4">
        <div class="p-4 info">
            <?php
            $user = Auth::user();
            $receipt = $user->receipt(); ?>
            @if(isset($receipt->get()[0]))
            <h4 class="mb-4">Ваши данные</h4>
            <div>{{ $user->name }} - {{$receipt->pluck('image')->implode('') }} -
                {{ $user->prize() }}
                - {{ $receipt->get()[0]['created_at']->format('d-m-Y')}}
                {{ $user->code() }}
                {{ $user->participatesStatus() }}
                - {{ $user->status() }}
            </div>
            @else
                <h4>У вас нет чека</h4>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#uploadReceipt').on('submit', function(e){
                e.preventDefault();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{{route('uploadReceipt')}}',
                    data: {
                        _token: _token,
                        userId: '{{ Auth::user()->id }}'
                    },

                    success: function(data){
                        if(typeof(data['receipt']) !== 'undefined'){
                            $('.info').html('');
                            $('.info').append('<h4 class="mb-4">Ваши данные</h4>'+
                            '<div>{{ $user->name }} - '+ data['receipt']['image'] +' - '+ data['receipt']['created_at'].substr(0,10) +' - '+ data['prize']  + data['code']  + ' - '+ data['status'] +'</div>'
                            );
                        }

                        $('.toast-body').html(data['message']);
                        $('.toast').toast('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            });
        });
    </script>
@endsection
