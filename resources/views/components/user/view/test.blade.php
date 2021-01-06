@extends('components.user.layouts.default')
@section('title', __('Login'))
@push('stylesheets')

@endpush


@section('content')

<h1>TEST PAGE</h1>

<body>
 
	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
				<h3 class="text-center"><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>
				<h5 class="text-center my-4">Eloquent One To One Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>url_platform</th>
							<th>logo_image_path</th>
                            <th>text</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $p)
						<tr>
							<td>{{ $p->url_platform }}</td>
							<td>{{ $p->list_platform->logo_image_path }}</td>
                            <td>{{ $p->list_text->text }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
 
</body>
@endsection


@push('javascript')

@endpush
