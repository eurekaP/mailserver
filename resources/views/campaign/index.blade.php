@extends('layouts.app')
<title>ACCOUNT : Campaigns</title>
@section('customStyle')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
@endsection
@section('content')
<div class="content-box">
    <div class="sub-header">
        Campaigns
    </div>
    <div class="my_box">
        <div class="box_head">
            <div class="item">
            </div>
            <div class="item">
                <div class="top_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#db0505" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                    </svg> &nbsp;<a href="{{url('campaign/create')}}">Start Your New Campaign Now</a>
                </div>
            </div>
        </div>
        <div class="d-none align-items-center animation">
            <div class="progress blue" style="width: 40px; height: 40px; margin: 0px 10px;"> 
                <span class="progress-left"> <span class="progress-bar" style="border-width: 4px;"></span> </span> <span class="progress-right"> <span class="progress-bar" style="border-width: 4px;"></span> </span>
            </div>
            <p class="m-0" style="font-size: 18px;">Sending . . . </p>
        </div>
        @if ( session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ( session('error'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="box_body">
            <nav class="navigation_layout_tabs">
                <a class="navigation__link navigation__link_active">All<span class="bracket" style="margin-left: 0.2rem;">({{$data->count()}})</span></a>
                <a class="navigation__link ">Sent<span class="bracket" style="margin-left: 0.2rem;">(0)</span></a>
                <a class="navigation__link ">Drafts<span class="bracket" style="margin-left: 0.2rem;">({{$data->count()}})</span></a>
                <a class="navigation__link ">Scheduled<span class="bracket" style="margin-left: 0.2rem;">(0)</span></a>
                <a class="navigation__link ">Suspended<span class="bracket" style="margin-left: 0.2rem;">(0)</span></a>
                <a class="navigation__link ">Running<span class="bracket" style="margin-left: 0.2rem;">(0)</span></a>
                <a class="navigation__link ">Archived<span class="bracket" style="margin-left: 0.2rem;">(0)</span></a>
            </nav>
            <!-- <div class="campaignListing__templateSearchBox___LgSif">
                <div class="templateSearch__box___24T3f">
                    <div class="searchEntry__field___1MLOZ entry__field">
                        <input type="search" class="input" placeholder="Campaign ID, Name" value="">
                        <button type="submit" class="input__affix input__button">
                            <svg viewBox="0 0 24 24" class="icon clickable__icon icon_standalone"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg>
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="campaign-content mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="min-width: 450px;">Campaigns</th>
                            <th>Recipients</th>
                            <!-- <th>Openers</th> -->
                            <!-- <th>Clickers</th> -->
                            <!-- <th>Unsub.</th> -->
                            <th style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="border-top-width: 0px;">
                        @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>
                                        <p class="fw-bold m-1" style="font-size: 18px;">{{ $value->name }}</p>
                                        <p class="m-1" style="color: #687484; font-size: 14px;">#{{$value->id}} Updated on {{ $value->updated_at }}</p>
                                        <div class="d-flex clickable-group">
                                            <a href="{{url('campaign/edit/'. $value->id)}}">Edit</a>
                                            <span> • </span>
                                            <form action="{{route('campaign.duplicate')}}" method="POST">
                                            @csrf
                                            <input name="id" value="{{$value->id}}" hidden>
                                            <input type="submit" value="Duplicate">
                                            </form>
                                            <span> • </span>
                                            <a data-bs-toggle="modal" data-bs-target="#sendTestModal">Send a test</a>
                                        <div>
                                    </td>
                                    <td></td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                    <td>
                                        <form class="send_campaign_form" action="{{route('campaign.sendcampaign')}}" method="POST" style="margin-bottom:10px;">
                                            @csrf
                                            <input name="id" value="{{$value->id}}" hidden>
                                            <button type="submit" class="btn-form-classic w-100">
                                                Send campaign
                                            </button>
                                        </form>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{url('campaign/edit/'. $value->id)}}"><button class="btn-form-classic">Edit</button></a>
                                            <button class="btn-form-classic" onclick="show(this)">Delete</button>
                                        </div>
                                        <form method="post" action="{{route('campaign.delete')}}">
                                            @csrf
                                            <input name="id" value="{{$value->id}}" hidden/>
                                            <div class="confirm-delete mt-2" style="display:none">
                                                <button type="submit" class="btn-form-danger text-white me-2">Yes</button>
                                                <button type="button" class="btn-form-primary" onclick="cancel(this)">Cancel</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">There are no data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $data->links() !!}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="sendTestModal" tabindex="-1" aria-labelledby="sendTestModalLabel" aria-hidden="true" role="dialog">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{route('campaign.sendtest')}}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sendTestModalLabel">Send a test email for campaign</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input name="id" value="{{$value->id}}" hidden>
                            <label class="form-label" for="receiver_email">Please input test campaign receiver address.</label>
                            <input type="email" class="form-control form-input" name="receiver_email" id="receiver_email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn-primary">Send a test</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('script')
<script>
    var doSubmit = false;
    $(document).ready(function(){
        $('.send_campaign_form').submit(function (event) {
            var form = $(this);
            console.log('Preventing');
            $(".animation").removeClass('d-none');
            $(".animation").addClass('d-flex');
            if(doSubmit) {
                doSubmit = false;
            } else {
                event.preventDefault();

                const myTimeout = setTimeout(submitForm, 4000);

                function submitForm() {
                    console.log("Finished")
                    doSubmit = true;
                    form.submit();
                    clearTimeout(myTimeout);
                }
            }
            
        });
    });

    function cancel(obj) {
        $(obj).parent().css('display', 'none');
    }

    function show(obj) {
        $('.confirm-delete').css('display', 'none');
        console.log($(obj).parent().parent().find('.confirm-delete')[0].style.display);
        $(obj).parent().parent().find('.confirm-delete')[0].style.display = "flex";
    }

    // function sendCampaignAnimation(e) {
    //     e.preventDefault()
    // }

</script>
@endsection

