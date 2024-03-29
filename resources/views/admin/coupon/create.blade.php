@extends('layouts.load')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('content')

<div class="content-area">

  <div class="add-product-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-description">
          <div class="body-area">
            @include('includes.admin.form-error')
            <form id="geniusformdata" action="{{route('admin-coupon-create')}}" method="POST"
              enctype="multipart/form-data">
              {{csrf_field()}}

              <div class="row">
                <div class="col-xl-12">
                    <div class="input-form">
                        <p><small>* {{ __("indicates a required field") }}</small></p>
                    </div>
                </div>
            </div>

              <div class="row">

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Code') }} *</h4>
                    <input type="text" class="input-field" name="code" placeholder="{{ __('Enter Code') }}" required=""
                    value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Type') }} *</h4>
                    <select id="type" name="type" required="">
                      <option value="">{{ __('Choose a type') }}</option>
                      <option value="0">{{ __('Discount By Percentage') }}</option>
                      <option value="1">{{ __('Discount By Amount') }}</option>
                    </select>
                  </div>
                </div>

                <div class="col-xl-4 hidden">
                  <div class="input-form">
                    <h4 class="heading"></h4>
                    <input type="text" class="input-field less-width" name="price" placeholder="" required=""
                    value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Quantity') }} *</h4>
                    <select id="times" required="">
                      <option value="0">{{ __('Unlimited') }}</option>
                      <option value="1">{{ __('Limited') }}</option>
                    </select>
                  </div>
                </div>

                <div class="col-xl-4 hidden">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Value') }} *</h4>
                    <input type="text" class="input-field less-width" name="times" placeholder="{{ __('Enter Value') }}"
                    value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Minimum Value') }} </h4>
                    <input type="text" class="input-field less-width" name="minimum_value" placeholder="{{ __('Enter minimum value') }}"
                    value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Maximum Value') }} </h4>
                    <input type="text" class="input-field less-width" name="maximum_value" placeholder="{{ __('Enter minimum value') }}"
                    value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('Start Date') }} *</h4>
                    <input type="text" class="input-field" name="start_date" id="from"
                    placeholder="{{ __('Select a date') }}" required="" value="">
                  </div>
                </div>

                <div class="col-xl-4">
                  <div class="input-form">
                    <h4 class="heading">{{ __('End Date') }} *</h4>
                    <input type="text" class="input-field" name="end_date" id="to" placeholder="{{ __('Select a date') }}"
                    required="" value="">
                  </div>
                </div>
             
              </div> <!--FECHAMENTO TAG ROW-->

              <div class="row justify-content-center">
              
                  <button class="addProductSubmit-btn" type="submit">{{ __('Create Coupon') }}</button>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

{{-- Coupon Type --}}
<script type="text/javascript">
  $('#type').on('change', function() {
    var val = $(this).val();
    var selector = $(this).parent().parent().next();
    if (val == "") {
      selector.hide();
    } else {
      if (val == 0) {
        selector.find('.heading').html('{{ __("Percentage") }} *');
        selector.find('input').attr("placeholder", "{{ __('Enter Percentage') }}").next().html('%');
        selector.css('display', 'flex');
      } else if (val == 1) {
        selector.find('.heading').html('{{ __("Amount") }} *');
        selector.find('input').attr("placeholder", "{{ __('Enter Amount') }}").next().html('');
        selector.css('display', 'flex');
      }
    }
  });
</script>

{{-- Coupon Qty --}}
<script>
  $(document).on("change", "#times", function() {
    var val = $(this).val();
    var selector = $(this).parent().parent().next();
    if (val == 1) {
      selector.css('display', 'flex');
    } else {
      selector.find('input').val("");
      selector.hide();
    }
  });
</script>

<script type="text/javascript">
 
  var dateToday = new Date();
  var dates = $("#from,#to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    changeYear: true,
    minDate: dateToday,
    onSelect: function(selectedDate) {
      var option = this.id == "from" ? "minDate" : "maxDate",
        instance = $(this).data("datepicker"),
        date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat,
          selectedDate, instance.settings);
      dates.not(this).datepicker("option", option, date);
    }
  });

</script>

@endsection