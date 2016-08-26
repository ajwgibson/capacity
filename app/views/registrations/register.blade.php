

<div class="row">

  <div class="col-sm-8">

    @if (Session::has('info'))
    <div class="alert alert-info alert-dismissable">
      <p>{{ Session::get('info') }}</p>
    </div>
    @elseif (isset($info))
    <div class="alert alert-info alert-dismissable">
      <p>{{{ $info }}}</p>
    </div>
    @endif

    @if (Session::has('message'))
    <div class="alert alert-danger alert-dismissable">
      <p>{{ Session::get('message') }}</p>
    </div>
    @elseif (isset($message))
    <div class="alert alert-danger alert-dismissable">
      <p>{{{ $message }}}</p>
    </div>
    @endif

    <p><em>Enter a delegate's name to search for a booking:</em></p>

    {{ Form::open(array('route' => 'register.search')) }}

    <div class="form-group">
      {{ Form::label('name', 'Delegate name', array ('class' => 'control-label')) }}
      <div class="row">
        <div class="col-xs-6">
          {{ Form::text('name', Input::get('name'), array ('class' => 'form-control')) }}
        </div>
      </div>
      <p class="help-block">
        <em>
          Try the delegate's first name, last name or both.<br/>
          If you're not sure of the correct spelling try putting in just part of the name.
        </em>
      </p>
    </div>

    {{ Form::submit('Search', array ('class' => 'btn btn-success')) }}

    {{ Form::close() }}

    @if (isset($bookings))

    <p style="margin-top: 20px;">The following bookings have matched the search criteria. Pick one to continue or search again.</p>

    @foreach ($bookings as $booking)

    <div class="panel panel-primary panel-search-result">

      <div class="panel-heading">
        <h3 class="panel-title text-uppercase">{{{ $booking->name() }}}</h3>
      </div>

      <div class="panel-body">

        <div class="row">

          <div class="col-sm-6">
            <dl>
              <dt>Source</dt>
              <dd>{{{ $booking->source }}}</dd>
              <dt>Booking reference or ticket number(s)</dt>
              <dd>{{{ $booking->numbers }}}</dd>
              <dt>Booked</dt>
              <dd>{{{ $booking->tickets }}}</dd>
              <dt>Registered</dt>
              <dd>{{{ $booking->registration_count() }}}</dd>
            </dl>
          </div>

          <div class="col-sm-6">
            <div class="pull-right">
              @if ($booking->registered())
              <p><b><i>This booking is already fully registered.</i></b></p>
              @else
              {{ Form::open(array('route' => 'register.booking', 'class' => '')) }}
              {{ Form::hidden('booking_id', $booking->id) }}
              @if ($booking->to_register() > 1)
              <div class="form-group">
                {{ Form::label('tickets', 'Tickets', array ('class' => 'control-label')) }}
                {{ Form::text('tickets', $booking->tickets - $booking->registration_count(), array ('class' => 'form-control tickets')) }}
              </div>
              @else
              {{ Form::hidden('tickets', 1) }}
              @endif
              <div class="form-group">
                {{ Form::label('email', 'Email address', array ('class' => 'control-label')) }}
                {{ Form::text('email', $booking->email, array ('class' => 'form-control email')) }}
                <p class="help-block">If this is blank, please ask for a contact email address for follow-up purposes</p>
              </div>
              {{ Form::submit('Register', array ('class' => 'btn btn-primary')) }}
              {{ Form::close() }}
              @endif
            </div>
          </div>

        </div>

      </div>

    </div>

    @endforeach

    @endif

  </div>

  <div class="col-sm-4">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Registration counters</h3>
      </div>
      <div class="panel-body">
        <ul class="list-group">
          <li class="list-group-item">Registered <span class="badge alert-info">{{{ $registration_count_total }}}</span></li>
          <li class="list-group-item">Expected <span class="badge alert-info">{{{ $expected_count }}}</span></li>
          <li class="list-group-item">Still to register <span class="badge alert-info">{{{ $still_to_register }}}</span></li>
        </ul>
      </div>
    </div>

    <div class="panel panel-default">

      <div class="panel-heading">
        <h3 class="panel-title">On the day booking &amp; registration</h3>
      </div>

      <div class="panel-body">

        @if ($errors->any())
        <div class="panel panel-danger">
          <div class="panel-heading">Validation Errors</div>
          <div class="panel-body">
            <ul>
              {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
          </div>
        </div>
        @endif

        <p class="text-danger">
          <span class="strong">Note:</span> Only use this if you cannot find a booking to register the delegate against.
        </p>

        {{ Form::open(array('route' => 'register.nobooking')) }}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
          {{ Form::label('name', 'Delegate name', array ('class' => 'control-label')) }}
          <div class="row">
            <div class="col-xs-12">
              {{ Form::text('name', '', array ('class' => 'form-control')) }}
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
          {{ Form::label('name', 'Contact email address', array ('class' => 'control-label')) }}
          <div class="row">
            <div class="col-xs-12">
              {{ Form::text('email', '', array ('class' => 'form-control')) }}
            </div>
          </div>
          <p class="help-block">Please ask for a contact email address for follow-up purposes</p>
        </div>

        <div class="form-group {{ $errors->has('tickets') ? 'has-error' : '' }}">
          {{ Form::label('tickets', 'Tickets', array ('class' => 'control-label')) }}
          <div class="row">
            <div class="col-xs-4">
              <div class="input-group">
                {{ Form::text('tickets', '', array ('class' => 'form-control')) }}
              </div>
            </div>
          </div>
        </div>

        {{ Form::submit('Register', array ('class' => 'btn btn-info')) }}

        {{ Form::close() }}
      </div>

    </div>

  </div>

</div>
