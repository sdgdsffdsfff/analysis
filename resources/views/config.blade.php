@extends('welcome')

@section('content')



<!-- Box -->
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Add New Config</h2>
	</div>
	<!-- End Box Head -->
	<form action="" method="post">
		<!-- Form -->
		<div class="form">
				<p>
					<span class="req">max 100 symbols</span>
					<label>Article Title <span>(Required Field)</span></label>
					<input type="text" class="field size1" />
				</p>
				<p class="inline-field">
					<label>Date</label>
					<select class="field size2">
						<option value="">23</option>
					</select>
					<select class="field size3">
						<option value="">July</option>
					</select>
					<select class="field size3">
						<option value="">2009</option>
					</select>
				</p>

				<p>
					<span class="req">max 100 symbols</span>
					<label>Content <span>(Required Field)</span></label>
					<textarea class="field size1" rows="10" cols="30"></textarea>
				</p>

		</div>
		<!-- End Form -->

		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="submit" />
		</div>
		<!-- End Form Buttons -->
	</form>
</div>
<!-- End Box -->

@endsection
