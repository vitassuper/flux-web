@extends('layouts.app')
{{--<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex">
                        <h3>Bots</h3>
                        <div><a href="{{route('bots.create')}}" class="btn btn-success">Create bot</a></div>
                    </div>
                    <div class="card-body">
                        @if($bots->count())
                            <table class="table table-striped table-bordered">
                                <thead class="sticky-top table-secondary">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Exchange</th>
                                    <th>Side</th>
                                    <th>Secret</th>
                                    <th>Copy bot</th>
                                    <th>Status</th>
                                    <th>Date created</th>
                                    <th>Date modified</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($bots as $bot)
                                    <tr>
                                        <td>{{$bot->id}}</td>
                                        <td>{{$bot->name ?? 'No name'}}</td>
                                        <td>{{$bot->exchange->name}}({{$bot->exchange->type}})</td>
                                        <td>{{$bot->getSideLabel()}}</td>
                                        <td>{{$bot->secret}}</td>
                                        <td>
                                            @if($bot->copyBot)
                                                {{$bot->copyBot->name}}({{$bot->copyBot->id}})
                                            @endif
                                        </td>
                                        <td>{{$bot->enabled ? 'Enabled' : 'Disabled'}}</td>
                                        <td>{{$bot->created_at}}</td>
                                        <td>{{$bot->updated_at}}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-info me-2"
                                                   href="{{route('bots.edit', $bot)}}">Edit</a>
                                                <button type="button" class="deleteButton btn btn-danger me-2"
                                                        data-attr="{{ route('bots.destroy', $bot) }}" title="Delete">
                                                    Delete
                                                </button>
                                                <a class="btn {{$bot->enabled ? 'btn-warning' : 'btn-success'}}"
                                                   href="{{route('bots.toggle', $bot)}}">{{$bot->enabled ? 'Disable' : 'Enable'}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        @else
                            <div class="col-md-8">
                                <span>There are no bots</span>&nbsp;<a href="{{route('bots.create')}}">Create bot</a>
                            </div>
                        @endif
                        <div>
                            <button>Copy</button>
                            <pre><code id="abc" class="language-json"></code></pre>
                        </div>
                    </div>
                    <div class="card-footer">{{$bots->links()}}</div>
                </div>
            </div>
        </div>
    </div>
    @include('components.delete')
    <script type="module">
        const jsonExample = JSON.stringify({
            "connector_secret": "test123",
            "type_of_signal": "open",
            "amount": 0.15,
            "pair": "ICP-USDT-SWAP"
        }, null, 4)

        $('#abc').append(jsonExample)
    </script>
@endsection
