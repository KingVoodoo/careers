
@push('head')
    <link href="{{ asset('web/css/seat-groups.css') }}" rel="stylesheet">
@endpush


@section('title', trans('seatgroups::seat.seat_groups'))
@section('page_header', trans('seatgroups::seat.seat_groups'))
@section('page_description', trans('seatgroups::seat.seat_groups_dashboard'))


@extends('web::layouts.grids.4-4-4')

@section('left')

        <h3>{{trans('seatgroups::seat.seat_groups_autogroup')}}</h3>
        <p>{{trans('seatgroups::seat.seat_groups_autogroup_description')}}</p>

        @foreach($seatgroups as $seatgroup)
          @if(!$seatgroup->isAllowedToSeeSeatGroup())
            @continue
          @endif
            @if($seatgroup->type === 'auto')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><img src="https://i.gyazo.com/188439c763f2b11bd87be0a3357d0eb8.png" alt="logo" height="60" width="60">{{$seatgroup->name}}</h3>

                        <button class="btn btn-link pull-right">
                            @if(Auth::user()->hasRole('seatgroups.edit'))
                                <a href="{{route('seatgroups.edit', $seatgroup->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                            @endif
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                    <textarea type="text" class="form-control" rows="7" name="description" readonly="readonly"skillplan >{{$seatgroup->description}}</textarea>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><img src="https://i.gyazo.com/188439c763f2b11bd87be0a3357d0eb8.png" alt="logo" height="60" width="60">Video</h3>
                      
                        <div class="clearfix"></div>
        <div class="panel panel-default">
        <div class="panel-body">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/LNUu75fH8Uc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div> 
        </div>
        </div> 
        


@endsection

@section('center')

    <h3>{{trans('seatgroups::seat.seat_groups_opengroup')}}</h3>
    <p>{{trans('seatgroups::seat.seat_groups_opengroup_description')}}</p>


    @foreach($seatgroups as $seatgroup)
      @if(!$seatgroup->isAllowedToSeeSeatGroup())
        @continue
      @endif
        @if($seatgroup->type === 'open')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left"><img src="https://i.gyazo.com/188439c763f2b11bd87be0a3357d0eb8.png" alt="logo" height="60" width="60">{{$seatgroup->name}}</h3>

                    @if(Auth::user()->hasRole('seatgroups.edit'))
                        <button class="btn btn-link pull-right">
                            <a href="{{route('seatgroups.edit', $seatgroup->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        </button>
                    @endif

                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                <div class="form-group col-md-12">
                        <label for="skillplan">{{trans('seatgroups::seat.seat_groups_skillplan')}}</label>
                        <i>- Train or inject these skills on your ALOT Character</i>
                        <textarea type="text" class="form-control" rows="7" name="description" readonly="readonly"skillplan >{{$seatgroup->description}}</textarea>
                        <sub>Click, CTRL+A,CTRL+C Import in Character Sheet</sub>
                        </div>
                    

                        @if(!$seatgroup->isMember())
                            {!! Form::open(['method' => 'POST',
                                        'route' => ['seatgroupuser.update', $seatgroup->id],
                                        'style'=>'display:inline'
                                        ]) !!}
                            {!! Form::submit(trans('seatgroups::seat.seat_join_opengroup'), ['class' => 'btn btn-success pull-right']) !!}
                            {!! Form::close() !!}
                        @elseif($seatgroup->isMember())
                            {!! Form::open(['method' => 'DELETE',
                                        'route' => ['seatgroupuser.update', $seatgroup->id],
                                        'style'=>'display:inline'
                                        ]) !!}
                            {!! Form::submit(trans('seatgroups::seat.seat_leave_opengroup'), ['class' => 'btn btn-danger pull-right']) !!}
                            {!! Form::close() !!}
                        @endif

                </div>
            </div>
        @endif

    @endforeach


@endsection

@section('right')

    <h3>{{trans('seatgroups::seat.seat_groups_managedgroup')}}</h3>
    <p>{{trans('seatgroups::seat.seat_groups_managedgroup_description')}}</p>

    @foreach($seatgroups as $seatgroup)
      @if(!$seatgroup->isAllowedToSeeSeatGroup())
        @continue
      @endif

      @if($seatgroup->type === 'managed')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title pull-left"><img src="https://i.gyazo.com/188439c763f2b11bd87be0a3357d0eb8.png" alt="logo" height="60" width="60">{{$seatgroup->name}}</h3>


              @if(Auth::user()->hasRole('seatgroups.edit'))
                <button class="btn btn-link pull-right">
                  <a href="{{route('seatgroups.edit', $seatgroup->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                </button>
              @endif

                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
            <textarea type="text" class="form-control" rows="7" name="description" readonly="readonly"skillplan >{{$seatgroup->description}}</textarea>
                <br>
                Members: {{$seatgroup->member->map(function($group) { return $group->main_character->name;})->implode(', ')}}


              @if($seatgroup->onWaitlist())
                {!! Form::open(['method' => 'DELETE',
                            'route' => ['seatgroupuser.update', $seatgroup->id],
                            'style'=>'display:inline'
                            ]) !!}
                {!! Form::submit(trans('seatgroups::seat.seat_leave_waitlist'), ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
              @elseif (!$seatgroup->isMember())
                {!! Form::open(['method' => 'POST',
                            'route' => ['seatgroupuser.update', $seatgroup->id],
                            'style'=>'display:inline'
                            ]) !!}
                {!! Form::submit(trans('seatgroups::seat.seat_join_waitlist'), ['class' => 'btn btn-success pull-right']) !!}
                {!! Form::close() !!}
              @elseif($seatgroup->isMember())
                {!! Form::open(['method' => 'DELETE',
                            'route' => ['seatgroupuser.update', $seatgroup->id],
                            'style'=>'display:inline'
                            ]) !!}
                {!! Form::submit(trans('seatgroups::seat.seat_leave_managedgroup'), ['class' => 'btn btn-danger pull-right']) !!}
                {!! Form::close() !!}
              @endif

            </div>
            <div class="panel-footer">
              Managers:
              {{$seatgroup->manager->map(function($user) { return $user->main_character->name; })->implode(', ')}}

              @if($seatgroup->isManager())
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn-xs btn-info pull-right" data-toggle="modal" data-target="#ModalSeATGrooup{{$seatgroup->id}}">Manage Members</button>


              <!-- Modal -->
              <div id="ModalSeATGrooup{{$seatgroup->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Manage Memebers: {{$seatgroup->name}}</h4>
                    </div>
                    <div class="modal-body">
                      <table class="table table-hover table-condensed">
                        @foreach($seatgroup->waitlist as $group)
                          <tr>
                            <td>
                              {{ $group->users->map(function($user) { return $user->name; })->implode(', ') }}
                            </td>
                            <td>
                              {!! Form::open(['method' => 'POST',
                                        'route' => ['seatgroupuser.acceptmember', $seatgroup->id, $group->id],
                                        'style'=>'display:inline'
                                        ]) !!}
                              {!! Form::submit(trans('seatgroups::seat.seat_accept_managedgroup'), ['class' => 'btn-xs btn-success pull-right']) !!}
                              {!! Form::close() !!}
                            </td>
                            <td>
                              {!! Form::open(['method' => 'DELETE',
                            'route' => ['seatgroupuser.removemember', $seatgroup->id, $group->id],
                            'style'=>'display:inline'
                            ]) !!}
                              {!! Form::submit(trans('seatgroups::seat.seat_deny_managedgroup'), ['class' => 'btn-xs btn-danger pull-right']) !!}
                              {!! Form::close() !!}
                            </td>
                          </tr>
                          @endforeach
                          @foreach($seatgroup->member as $group)
                            <tr>
                              <td>
                                {{ $group->users->map(function($user) { return $user->name; })->implode(', ') }}
                              </td>
                              <td></td>
                              <td>
                                {!! Form::open(['method' => 'DELETE',
                            'route' => ['seatgroupuser.removemember', $seatgroup->id, $group->id],
                            'style'=>'display:inline'
                            ]) !!}
                                {!! Form::submit(trans('seatgroups::seat.seat_removefrom_managedgroup'), ['class' => 'btn-xs btn-danger pull-right']) !!}
                                {!! Form::close() !!}
                              </td>
                            </tr>
                          @endforeach
                      </table>

                    </div>
                  </div>

                </div>
              </div>
              @endif
            </div>

        </div>
      @endif
      @if($seatgroup->type === 'hidden')
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title pull-left"><img src="https://i.gyazo.com/188439c763f2b11bd87be0a3357d0eb8.png" alt="logo" height="60" width="60">{{$seatgroup->name}}</h3>

            <button class="btn btn-link pull-right">
              @if(Auth::user()->hasRole('seatgroups.edit'))
                <a href="{{route('seatgroups.edit', $seatgroup->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              @endif
            </button>
            <div class="clearfix"></div>
          </div>
          <div class="panel-body">
            {{$seatgroup->description}} <br>
            Members: {{$seatgroup->member->map(function($group) { return $group->main_character->name;})->implode(', ')}}
          </div>
        </div>
      @endif
    @endforeach


@endsection
