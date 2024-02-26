<div class="row justify-content-center align-items-center">
	<div class="col-8 col-sm-5 col-lg-4 col-xl-5 remove-padding">
		<div class="item-filter w-100 justify-content-sm-end align-items-center">
			<ul class="filter-list">
				<li class="item-short-area d-flex align-items-center">
						<p>{{__("Show")}} :</p>
						<select id="qty" name="qty" class="short-item ml-3 px-0 px-xl-3">
							<option value="25" {{$qty === '25' ? 'selected' : ''}}>25</option>
							<option value="50" {{$qty === '50' ? 'selected' : ''}}>50</option>
							<option value="75" {{$qty === '75' ? 'selected' : ''}}>75</option>
							<option value="100" {{$qty === '100' ? 'selected' : ''}}>100</option>
						</select>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-8 col-sm-6 col-lg-8 col-xl-7 remove-padding">
		<div class="item-filter w-100 justify-content-end justify-content-sm-start align-items-center ml-0 ml-sm-4">
			<ul class="filter-list">
				<li class="item-short-area d-flex align-items-center">
						<p>{{__("Sort By")}} :</p>
						<select id="sortby" name="sort" class="short-item ml-3 px-0 px-xl-3">
							<option value="date_desc" {{$sort === 'date_desc' ? 'selected' : ''}}>{{__("Latest Product")}}</option>
							<option value="date_asc" {{$sort === 'date_asc' ? 'selected' : ''}}>{{__("Oldest Product")}}</option>
							<option value="name_asc" {{$sort === 'name_asc' ? 'selected' : ''}}>{{__("Name")}} (A-Z)</option>
							<option value="name_desc" {{$sort === 'name_desc' ? 'selected' : ''}}>{{__("Name")}} (Z-A)</option>
							<option value="price_asc" {{$sort === 'price_asc' ? 'selected' : ''}}>{{__("Lowest Price")}}</option>
							<option value="price_desc" {{$sort === 'price_desc' ? 'selected' : ''}}>{{__("Highest Price")}}</option>
							<option value="availability" {{$sort === 'availability' ? 'selected' : ''}}>{{__("Availability")}}</option>
						</select>
				</li>
			</ul>
		</div>
	</div>
</div>
