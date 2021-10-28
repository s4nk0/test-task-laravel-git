@extends('layouts.app')

@section('content')
    <div class="container bg-white rounded shadow-sm my-4 p-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Все данные
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <tbody>
                    @foreach($users as $user)
                        @if(isset($user->receipt()->get()[0]))
                            <tr style="padding: 3px 2px"><td>{{ $user->name }} - {{ $user->receipt()->pluck('image')->implode('') }} - {{ $user->prize() }} - {{ $user->receipt()->get()[0]['created_at']->format('d.m.Y') }} {{ $user->code() }} {{ $user->participatesStatus() }} - {{ $user->status() }}</td></tr>
                        @else
                            <tr style="padding: 3px 2px"><td>{{ $user->name }} - Не загрузил чек</td></tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>

        </div>
    </div>
@endsection

@section('style')
    <link href="{{ URL::asset('css/dataTable.css') }}" rel="stylesheet" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/datatables-simple.js') }}"></script>
@endsection
