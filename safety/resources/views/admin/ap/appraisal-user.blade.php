@extends('admin.layout')

@section('content')
    @if (session()->has('msg'))
        <div class="alert alert-success"> {{ session('msg') }}</div>
    @endif
    <h1 class="h3 mb-4 text-gray-800">Appraisal Category
    </h1>
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($users as $result)
                                    @php
                                        $content = json_decode($result->content);
                                        $_name = '';

                                        try {
                                            if ($content->personalDetails) {
                                                $_name = $content->personalDetails->name;
                                            }
                                        } catch (\Throwable $th) {
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $_name }}</td>
                                        <td>{{ $result->email }}</td>
                                        <td>{{ $result->contact }}</td>
                                        <td>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id]) }}"
                                                class="btn btn-primary mb-3" target="_blank">
                                                Print - whole form
                                            </a>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 3, 'e' => 4]) }}" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 3,4</a>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 18, 'e' => 18]) }}" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 18</a>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 3, 'e' => 4, 's1' => 18, 'e1' => 20]) }}" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 3,4,18,19,20</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
