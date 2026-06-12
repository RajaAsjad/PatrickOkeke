@extends('layouts.admin.app')
@section('title', 'Contact Us Details')
@section('content')
@push('css')
<style>
	.contact-admin {
		--ct-ember: #a85a32;
		--ct-ember-deep: #7c4a2d;
		--ct-ember-light: #c9845c;
		--ct-cream: #f5f3f0;
	}
	.contact-detail-card {
		background: #ffffff;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(28, 25, 23, 0.08);
		border: 1px solid rgba(168, 90, 50, 0.12);
		overflow: hidden;
	}
	.contact-detail-header {
		background: linear-gradient(135deg, var(--ct-ember-deep) 0%, var(--ct-ember) 52%, var(--ct-ember-light) 100%) !important;
		color: #fff;
		padding: 22px 30px;
		border-radius: 16px 16px 0 0;
		border-bottom: 2px solid rgba(124, 74, 45, 0.45);
		box-shadow: 0 4px 16px rgba(168, 90, 50, 0.2);
		text-align: center;
	}
	.contact-detail-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.06em;
		color: #fff !important;
		text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
	}
	.contact-detail-body {
		padding: 30px 40px;
		background: var(--ct-cream);
	}
	.contact-detail-table {
		background: #fff;
		border-radius: 12px;
		border: 1px solid rgba(168, 90, 50, 0.1);
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(28, 25, 23, 0.05);
	}
	.contact-detail-table table { margin: 0; }
	.contact-detail-table th {
		width: 180px;
		background: linear-gradient(90deg, #fdf8f4 0%, #f5ebe0 100%);
		color: var(--ct-ember-deep);
		font-weight: 600;
		font-size: 14px;
		padding: 14px 16px;
		border: 1px solid rgba(168, 90, 50, 0.1);
	}
	.contact-detail-table td {
		padding: 14px 16px;
		font-size: 14px;
		color: #374151;
		border: 1px solid rgba(168, 90, 50, 0.08);
	}
	.contact-detail-table tr:hover td { background: rgba(168, 90, 50, 0.04); }
	.btn-view-all {
		background: linear-gradient(135deg, var(--ct-ember-deep) 0%, var(--ct-ember) 100%) !important;
		color: #fff !important;
		border: none;
		padding: 10px 24px;
		border-radius: 10px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.2s ease;
		margin-bottom: 20px;
		box-shadow: 0 4px 14px rgba(168, 90, 50, 0.3);
	}
	.btn-view-all:hover {
		background: linear-gradient(135deg, #6b3f26 0%, var(--ct-ember-deep) 100%) !important;
		color: #fff !important;
		box-shadow: 0 6px 20px rgba(168, 90, 50, 0.38);
		transform: translateY(-1px);
	}
</style>
@endpush

<section class="content-header contact-admin" style="margin-bottom: 0;">
	<div class="contact-detail-card">
		<div class="contact-detail-header">
			<h1>Contact Us Details</h1>
		</div>
		<div class="contact-detail-body">
			<div class="d-flex justify-content-end mb-3">
				<a href="{{ route('contactus.index') }}" class="btn-view-all"><i class="fa fa-list"></i> View All</a>
			</div>
			<div class="contact-detail-table">
				<table class="table table-bordered mb-0">
					<tr>
						<th>Name</th>
						<td>{{ $model->first_name }} {{ $model->last_name }}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $model->email }}</td>
					</tr>
					<tr>
						<th>Phone</th>
						<td>{{ $model->phone }}</td>
					</tr>
					<tr>
						<th>Venue/Event</th>
						<td>{{ $model->address ?? '—' }}</td>
					</tr>
					<tr>
						<th>Message</th>
						<td>{!! nl2br(e($model->message)) !!}</td>
					</tr>
					<tr>
						<th>Date</th>
						<td>{{ $model->created_at ? \Carbon\Carbon::parse($model->created_at)->format('d F Y, h:i A') : '—' }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
