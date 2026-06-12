@extends('layouts.admin.app')
@section('content')
@section('title', $page_title)
@push('css')
@include('admin.page_setting.partials.theme')
@endpush


<section class="content page-admin">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="parent_slug" value="{{ $model->slug }}">
				<div class="page-setting-shell home-about-container">
					<div class="page-setting-body home-about-body">
						<div class="section-banner" style="margin-top: 0;">
							<h3>Home About Settings</h3>
							<a href="{{ route('page.index') }}" class="btn btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div>

						@if (session('message'))
						<div class="page-setting-alert home-about-alert">{{ session('message') }}</div>
						@endif

						<div class="section-block">
							 
							<div class="form-group">
								<label for="home_about_title">About Title</label>
								<input type="text" id="home_about_title" name="home_about_title" class="form-control" value="{{ isset($page_data['home_about_title']) ? $page_data['home_about_title'] : '' }}" placeholder="Enter title">
							</div>
							<div class="form-group">
								<label for="home_about_description">Description</label>
								<textarea id="home_about_description" name="home_about_description" class="form-control texteditor" cols="30" rows="10" placeholder="Enter description">{!! isset($page_data['home_about_description']) ? $page_data['home_about_description'] : '' !!}</textarea>
							</div> 
						</div>

						<div class="section-block"> 
							<div class="form-group">
								<label>Bullet points</label>
								<div id="bullet-points-wrap">
									@php
										$bullets = isset($page_data['home_about_bullets']) && is_array($page_data['home_about_bullets']) ? $page_data['home_about_bullets'] : [];
										if (empty($bullets)) { $bullets = ['']; }
									@endphp
									@foreach($bullets as $idx => $bullet)
									<div class="bullet-point-row">
										<input type="text" name="home_about_bullets[]" class="form-control" value="{{ is_string($bullet) ? e($bullet) : '' }}" placeholder="e.g. 45 years of professional performance">
										<button type="button" class="btn btn-danger btn-remove-bullet" title="Remove"><i class="fa fa-minus"></i></button>
									</div>
									@endforeach
								</div>
								<button type="button" id="btn-add-bullet" class="btn btn-sm"><i class="fa fa-plus"></i> Add bullet point</button>
							</div>
						</div>

						<div class="section-block">
							 
							<div class="form-group">
								<label for="home_about_image">About section image</label>
								<input type="file" id="home_about_image" name="home_about_image" class="form-control" accept="image/*">
								@if(isset($page_data['home_about_image']) && $page_data['home_about_image'])
									<div style="margin-top: 12px;">
										<img src="{{ asset('admin/assets/images/page/' . $page_data['home_about_image']) }}" class="existing-photo" alt="Current" style="height: 100px;">
									</div>
								@endif
							</div>
						</div>

						<div class="settings-section">
							<div class="form-group">
								<label for="home_about_status_toggle">Show on Home Page?</label>
								<div class="toggle-switch-container">
									<label class="toggle-switch">
										@php
											$activeStatus = isset($page_data['home_about_active_status']) ? $page_data['home_about_active_status'] : '1';
											$isActive = $activeStatus == '1' || $activeStatus === 1;
										@endphp
										<input type="checkbox" id="home_about_status_toggle" {{ $isActive ? 'checked' : '' }}>
										<span class="toggle-slider"></span>
									</label>
									<span class="toggle-label-text">Toggle to show or hide Home About section</span>
									<span class="toggle-status {{ $isActive ? 'active' : 'inactive' }}" id="home-about-toggle-status">{{ $isActive ? 'Show' : 'Hide' }}</span>
									<input type="hidden" name="home_about_active_status" id="home_about_active_status" value="{{ $isActive ? '1' : '0' }}">
								</div>
							</div>
						</div>

						<div class="action-section">
							<button type="submit" class="btn-update" name="form_about">
								<i class="fa fa-save"></i> Update Settings
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('js')
<script>
	$(document).ready(function() {
		if ($(".texteditor").length > 0) {
			tinymce.init({
				selector: "textarea.texteditor",
				theme: "modern",
				height: 150,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality emoticons template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
			});
		}

		$('#home_about_status_toggle').on('change', function() {
			var isChecked = $(this).is(':checked');
			$('#home_about_active_status').val(isChecked ? '1' : '0');
			var $statusBadge = $('#home-about-toggle-status');
			if (isChecked) {
				$statusBadge.removeClass('inactive').addClass('active').text('Show');
			} else {
				$statusBadge.removeClass('active').addClass('inactive').text('Hide');
			}
		});

		$('#btn-add-bullet').on('click', function() {
			var row = '<div class="bullet-point-row">' +
				'<input type="text" name="home_about_bullets[]" class="form-control" value="" placeholder="e.g. 45 years of professional performance">' +
				'<button type="button" class="btn btn-danger btn-remove-bullet" title="Remove"><i class="fa fa-minus"></i></button></div>';
			$('#bullet-points-wrap').append(row);
		});

		$(document).on('click', '.btn-remove-bullet', function() {
			var rows = $('#bullet-points-wrap .bullet-point-row');
			if (rows.length > 1) {
				$(this).closest('.bullet-point-row').remove();
			}
		});
	});
</script>
@endpush
