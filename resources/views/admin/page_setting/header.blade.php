@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
@include('admin.page_setting.partials.theme')
@endpush

<section class="content page-admin">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ route('page_setting.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="parent_slug" value="{{ $model->slug }}">
				<div class="page-setting-shell header-settings-container">
					<div class="page-setting-body header-settings-body">
						<div class="section-banner">
							<h3>Header Settings</h3>
							<a href="{{ route('page.index') }}" class="btn btn-sm">
								<i class="fa fa-arrow-left"></i> Back
							</a>
						</div> 

						<div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-image"></i> Branding Assets</h4>
							</div>

							<div class="form-group">
								<label for="header_favicon">Favicon</label>
								<input type="file" id="header_favicon" name="header_favicon" class="form-control" accept="image/*">
								<small class="form-hint">Recommended size: 32×32 or 16×16 pixels (PNG, ICO, or SVG)</small>
								@if (isset($page_data['header_favicon']))
								<div class="image-preview-container">
									<img src="{{ asset('public/admin/assets/images/page/' . $page_data['header_favicon']) }}" class="existing-photo" style="height:50px;" alt="Current Favicon">
								</div>
								@endif
							</div>

							<div class="form-group">
								<label for="header_logo">Logo</label>
								<input type="file" id="header_logo" name="header_logo" class="form-control" accept="image/*">
								<small class="form-hint">Recommended: PNG with transparent background</small>
								@if (isset($page_data['header_logo']))
								<div class="image-preview-container">
									<img src="{{ asset('public/admin/assets/images/page/' . $page_data['header_logo']) }}" class="existing-photo" style="height:100px;" alt="Current Logo">
								</div>
								@endif
							</div>
						</div>

						{{-- <div class="section-block">
							<div class="section-heading">
								<h4><i class="fa fa-share-alt"></i> Social Media Links</h4>
							</div>

						<div class="social-links-grid">
							<div class="form-group">
								<label for="footer_facebook"><i class="fa fa-instagram"></i> Instagram</label>
								<input type="url" id="footer_instagram" name="footer_instagram" class="form-control" value="{{ isset($page_data['footer_instagram']) ? $page_data['footer_instagram'] : '' }}" placeholder="https://instagram.com/yourpage">
							</div>

							<div class="form-group">
								<label for="footer_fieldlevel"><i class="fa fa-futbol-o"></i> Field Level</label>
								<input type="url" id="footer_fieldlevel" name="footer_fieldlevel" class="form-control" value="{{ isset($page_data['footer_fieldlevel']) ? $page_data['footer_fieldlevel'] : '' }}" placeholder="https://fieldlevel.com/yourprofile">
							</div>

							<div class="form-group">
								<label for="footer_twitter"><i class="fa fa-twitter"></i> X (Twitter) Link</label>
								<input type="url" id="footer_twitter" name="footer_twitter" class="form-control" value="{{ isset($page_data['footer_twitter']) ? $page_data['footer_twitter'] : '' }}" placeholder="https://twitter.com/yourhandle">
							</div>
						</div>
						</div> --}}

						<div class="action-section">
							<button type="submit" class="btn-update" name="form_header">
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
	// File input preview (optional enhancement)
	$('input[type="file"]').on('change', function() {
		var fileName = $(this).val().split('\\').pop();
		if (fileName) {
			console.log('Selected file: ' + fileName);
		}
	});
});
</script>
@endpush
