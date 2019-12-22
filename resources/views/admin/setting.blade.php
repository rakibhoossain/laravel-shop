@extends('admin.layouts.admin')
@section('content')
<div class="card">
  <h5 class="card-header">Settings</h5>
  <div class="card-body">

<form method="post" action="{{ config('app_settings.url') }}" class="form-horizontal mb-3" enctype="multipart/form-data" role="form">            
  {!! csrf_field() !!}


    <div class="row">
      <div class="col-md-2 mb-3">
        <ul class="nav nav-pills flex-column" id="settingsTab" role="tablist">
          @if( isset($settingsUI) && count($settingsUI) )
              @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
              <li class="nav-item">
                <a class="nav-link @if($loop->index == 0) active @endif" id="{{$section}}-tab" data-toggle="tab" href="#{{$section}}" role="tab" aria-controls="{{$section}}" aria-selected="false">{{ $fields['title'] }}</a>
              </li>
              @endforeach
          @endif
        </ul>
      </div>

      <div class="col-md-10">
        <div class="tab-content" id="settingsTabContent">

                  @if( isset($settingsUI) && count($settingsUI) )
                      @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
                        <div class="tab-pane fade @if($loop->index == 0) show active @endif" id="{{$section}}" role="tabpanel" aria-labelledby="{{$section}}-tab">

                          @component('app_settings::section', compact('fields'))
                              <div class="{{ Arr::get($fields, 'section_body_class', config('app_settings.section_body_class', 'card-body')) }}">
                                  @foreach(Arr::get($fields, 'inputs', []) as $field)
                                      @if(!view()->exists('app_settings::fields.' . $field['type']))
                                          <div style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">
                                              Defined setting <strong>{{ $field['name'] }}</strong> with
                                              type <code>{{ $field['type'] }}</code> field is not supported. <br>
                                              You can create a <code>fields/{{ $field['type'] }}.balde.php</code> to render this input however you want.
                                          </div>
                                      @endif
                                      @includeIf('app_settings::fields.' . $field['type'] )
                                  @endforeach
                              </div>
                          @endcomponent

                      </div> <!--pane -->
                      @endforeach
                  @endif

        </div>

        <div class="row m-b-md">
          <div class="col-md-12">
              <button class="btn-primary btn">
                  {{ Arr::get($settingsUI, 'submit_btn_text', 'Save Settings') }}
              </button>
          </div>
        </div>

      </div>
    </div>

</form>









  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {

  });
</script>
@endpush