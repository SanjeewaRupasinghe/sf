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
                                    <th>Status</th>

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
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 3, 'e' => 4]) }}"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                3,4</a>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 18, 'e' => 18]) }}"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                18</a>
                                            <a href="{{ route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 3, 'e' => 4, 's1' => 18, 'e1' => 20]) }}"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                3,4,18,19,20</a>
                                        </td>
                                        <td>
                                            @if ($result->status == 1)
                                                <span class="text-success">
                                                    UNLOCKED
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    LOCKED
                                                </span>

                                                <!-- MODAL -->
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#unlockModal{{ $result->id }}">
                                                    Unlock
                                                </button>

                                                <div class="modal fade" id="unlockModal{{ $result->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="unlockModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="unlockModalLabel">
                                                                    Unlock User {{ $result->email }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to unlock {{ $result->email }}
                                                                    @if ($_name)
                                                                        ({{ $_name }})
                                                                    @endif?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <a href="{{ route('admin.appraisal.user.unlock', ['userId' => $result->id]) }}"
                                                                    class="btn btn-primary">Unlock</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END MODAL -->
                                            @endif
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
