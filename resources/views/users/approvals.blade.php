@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">Waiting for approvals</h3>

                <form method="get" action="/approval">
                    <div class="row my-3">
                        <div class="col-md-3 mb-1">
                            <input class="form-control"
                                value="{{ isset($search['search_name']) ? $search['search_name'] : '' }}" type="text"
                                name="search_name" placeholder="Search for name">
                        </div>
                        <div class="col-md-3 mb-1">
                            <select class="form-control" name="search_hall">
                                @if (isset($search['search_hall']))
                                    <option value="{{ $search['search_hall'] }}">{{ $search['search_hall'] }}</option>
                                @endif
                                <option value="">Select hall</option>
                                @foreach ($halls as $hall)
                                    @if (isset($search['search_hall']) && $search['search_hall'] == $hall->hall)
                                        @continue
                                    @endif
                                    <option value="{{ $hall->hall }}">{{ $hall->hall }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-1">
                            <select class="form-control" name="search_department">
                                @if (isset($search['search_department']))
                                    <option value="{{ $search['search_department'] }}">{{ $search['search_department'] }}
                                    </option>
                                @endif
                                <option value="">Select department</option>
                                @foreach ($departments as $department)
                                    @if (isset($search['search_department']) && $search['search_department'] == $department->department)
                                        @continue
                                    @endif
                                    <option value="{{ $department->department }}">{{ $department->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-1">
                            <input class="form-control" type="text"
                                value="{{ isset($search['search_address']) ? $search['search_address'] : '' }}"
                                name="search_address" placeholder="Search for address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-3">
                                <a href="/approval" class="btn btn-danger">Clear All</a>
                                <button type="submit" class="btn btn-success" name="search_submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped mt-3" style="background: #d5eadb">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Hall</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->hall }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <a href="/user/{{ $user->id }}" class="btn btn-sm btn-info">View</a>
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
