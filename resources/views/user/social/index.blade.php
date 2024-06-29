@extends('user.main')
@section('title', 'My Profile - vCards.pk')

@section('styles')

@endsection

@push('css')
@endpush



@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">


                @if ($links->count() > 0)
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">My Address Book</h4>
                                </div>
                            </div>
                            <div class="iq-card-body px-4">
                                <div class="row mb-2">
                                    <table>

                                        <table class="table">
                                            <thead class="table-striped">
                                                <tr>
                                                    <th scope="col">Platform</th>
                                                    <th scope="col">link</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($links as $link)
                                                    <tr>
                                                        <td>{{ $link->platform->name }}</td>
                                                        <td>{{ $link->link }}</td>
                                                        <td>
                                                            <a href="{{ route('user.social.destroy',$link->id) }}" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">My Social Links</h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">
                            <form action="{{ route('user.social.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="social_platform_id">Platform</label>
                                        <select name="social_platform_id" id="social_platform_id" class="form-control"
                                            required>
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="link">Link*</label>
                                        <input type="text" class="form-control" name="link" placeholder="e.g. Google"
                                            value="{{ old('link') }}" required>
                                    </div>


                                </div>



                                <div class="row text-right">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-3">Update</button>
                                        <a href="{{ route('users.index') }}" class="btn iq-bg-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="address-data">


            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection

@push('js')
@endpush
