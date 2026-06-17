@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.books.partials.theme')
@endpush

<section class="content book-admin">
	<div class="book-form-header-bar">
		<h1>{{ $page_title }}</h1>
		@can('book-list')
		<a href="{{ route('book.index') }}" class="btn-back"><i class="fa fa-arrow-left"></i> All Books</a>
		@endcan
	</div>

	<form action="{{ route('book.update', $model->id) }}" method="post" enctype="multipart/form-data" id="bookForm">
		@csrf
		@method('PUT')
		<div class="book-form-shell">
			<div class="book-form-body">
				<div class="book-form-banner">
					<h3>Edit Book</h3>
					<p>Update "{{ $model->title }}". Changes reflect on the website immediately.</p>
				</div>

				@include('admin.books.partials.form-fields', ['model' => $model])

				<div class="book-form-actions">
					<button type="submit" class="book-btn-submit"><i class="fa fa-save"></i> Save Changes</button>
					<a href="{{ route('book.index') }}" class="book-btn-cancel">Cancel</a>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection

@push('js')
<script>
$(document).ready(function() {
	function bindToggle(checkboxId, hiddenId) {
		var cb = document.getElementById(checkboxId);
		var hidden = document.getElementById(hiddenId);
		if (!cb || !hidden) return;
		function sync() { hidden.value = cb.checked ? '1' : '0'; }
		cb.addEventListener('change', sync);
		sync();
	}
	bindToggle('featured_toggle', 'featured');
	bindToggle('status_toggle', 'status');

	$('.book-upload-zone input[type="file"]').on('change', function() {
		var name = this.files[0] ? this.files[0].name : '';
		if (name) $(this).siblings('.book-upload-zone__text').text(name);
	});
});
</script>
@endpush
