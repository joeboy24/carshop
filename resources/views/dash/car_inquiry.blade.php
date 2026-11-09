
@extends('layouts.dashlay')

@section('header_nav')
    @include('inc.header_nav')  
@endsection

@section('sidebar_menu')
    @include('inc.cms_sidebar')
@endsection

@section('content')


    <div class="page-heading">
        <h3><i class="fa fa-envelope color3"></i>&nbsp;&nbsp;Inquiries</h3>
        {{-- <a href="/emp_report"><p class="print_report">&nbsp;<i class="fa fa-print"></i>&nbsp; Print Emp. Report</p></a>
        <a href="#"><button type="submit" class="print_btn_small"><i class="fa fa-refresh"></i></button></a> --}}
    </div>

    {{ $inqs->links() }}
    <div class="row">
        <div class="col-12 col-xl-12">
            @include('inc.messages') 
            <div class="card">
                <div class="card-body">

                    <p>&nbsp;</p>
                    {{-- <div class="col-md-10 offset-md-1"> --}}
                        <!-- Leaves View -->
                        <div class="table-responsive">
                            @if (count($inqs) > 0)
                                <table class="table mb-0 table-lg">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name / Contact</th>
                                            <th>Message</th>
                                            <th class="align_right">Action</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        @foreach ($inqs as $inq)
                                            @if ($inq->del != 'null')
                                                @if ($c % 2 == 1)
                                                    <tr class="bg9">
                                                @else
                                                    <tr>
                                                @endif
                                                    <td class="text-bold-500">{{$c++}}</td>
                                                    <td class="text-bold-500">{{ $inq->name }}
                                                        <p class="gray_p">{{ $inq->email }}</p>
                                                        <p class="small_p">{{ $inq->phone }}</p>
                                                    </td>
                                                    <td class="text-bold-500">{{ $inq->message }}
                                                        <span><p class="small_p">Reply: <span class="color12">{{ $inq->reply }}</span></p></span>
                                                    </td>
                                                    {{-- <td class="text-bold-500">@if ($lv->dob != '') {{date('D.. M, d Y', strtotime($lv->dob))}} @endif</td> --}}
                                                    <td class="text-bold-500 align_right">

                                                        <form action="{{ action('CardashController@update', $inq->id) }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @csrf
                                                            
                                                            @if ($inq->status == 'active')
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#reply{{$inq->id}}" class="my_trash_small bg7"><i class="fa fa-pencil"></i></button>
                                                                {{-- <button type="submit" name="update_action" value="close_inq" class="my_trash_small bg7"><i class="fa fa-envelope-o"></i></button> --}}
                                                            @else
                                                                <button type="button" class="my_trash_small"><i class="fa fa-envelope-open-o"></i></button>
                                                            @endif

                                                        </form>

                                                    </td>
                                                </tr>


                                                <!-- Reply to Inquiries -->
                                                <div class="modal fade" id="reply{{$inq->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    Repy to {{$inq->name}}'s Inquiry
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ action('CardashController@update', $inq->id) }}" method="POST">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="col-md-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <div class="form-group with-title mb-3">
                                                                                    <textarea class="form-control" rows="3" maxlength="200" readonly>{{$inq->message}}</textarea>
                                                                                    <label>Message</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label>Reply</label>
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <div class="form-group with-title mb-3">
                                                                                    <textarea name="reply_msg" class="form-control" rows="3" maxlength="250" required></textarea>
                                                                                    <label>Type Reply Here</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            
                                                                </div> 
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="update_action" value="close_inq" class="load_btn"><i class="fa fa-send"></i>&nbsp; Send</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $inqs->links() }}
                            @else
                                <div class="alert alert-danger">
                                    No Records Found
                                </div>
                            @endif
                        </div>
                    {{-- </div> --}}

                </div>
            </div>
        </div>
    </div>
        

@endsection

 