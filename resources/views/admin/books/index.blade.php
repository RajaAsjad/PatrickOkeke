@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.books.partials.theme')
@endpush

<input type="hidden" id="page_url" value="{{ route('book.index') }}">
<section class="content-header book-admin" style="margin-bottom:0;">
	<div class="book-shell">
		<div class="book-page-header">
			<h1>{{ $page_title }}</h1>
			<p>Manage book products, covers, and downloadable files</p>
		</div>

		<div class="book-stats">
			<div class="stat-box">
				<div class="num">{{ $totalBooks ?? 0 }}</div>
				<div class="lbl">Total Books</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $activeBooks ?? 0 }}</div>
				<div class="lbl">Published</div>
			</div>
			<div class="stat-box">
				<div class="num">{{ $inactiveBooks ?? 0 }}</div>
				<div class="lbl">Draft</div>
			</div>
			@can('book-create')
			<div class="stat-box stat-box--action">
				<a href="{{ route('book.create') }}" class="btn-add-book"><i class="fa fa-plus"></i> Add Book</a>
			</div>
			@endcan
		</div>

		<div class="book-search">
			<div class="book-search__inner">
				<input type="text" id="search" class="form-control" placeholder="Search by title or category" style="max-width:300px;flex:1;">
				<select id="status" class="form-control" style="max-width:160px;">
					<option value="All" selected>All status</option>
					<option value="1">Published</option>
					<option value="2">Draft</option>
				</select>
				<button type="button" class="btn btn-filter" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
			</div>
		</div>

		<div class="book-body">
			<div id="body">
				@include('admin.books.search', ['models' => $models])
			</div>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
$(document).ready(function() {
	$('#btn-filter').on('click', function() {
		var pageurl = $('#page_url').val();
		var search = $('#search').val();
		var status = $('#status').val();
		$.get(pageurl + '?page=1&search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status), function(response) {
			$('#body').html(response);
		});
	});

	$('#search').on('keypress', function(e) {
		if (e.which === 13) $('#btn-filter').click();
	});

	$(document).on('click', '.book-delete', function() {
		var $btn = $(this);
		var deleteUrl = $btn.data('del-url');
		var rowId = $btn.data('row-id');
		Swal.fire({
			title: 'Delete this book?',
			text: 'The cover and downloadable file will also be removed.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#a85a32',
			cancelButtonColor: '#78716c',
			confirmButtonText: 'Yes, delete it'
		}).then(function(result) {
			if (!result.isConfirmed) return;
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				url: deleteUrl,
				type: 'DELETE',
				success: function(response) {
					if (response) {
						$('#book-row-' + rowId).fadeOut(200, function() { $(this).remove(); });
						Swal.fire('Deleted', 'Book removed successfully.', 'success');
					}
				}
			});
		});
	});
});
</script>
@endpush
