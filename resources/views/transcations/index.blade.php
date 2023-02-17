@extends('layouts.app')

@section('content')
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        
    @endforeach
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Transactions  {{ $monthYear }}</h1>
                </div>
                <div class="form-group col-sm-3">
                    <input type="text" class="form-control" value="{{ $monthYear }}"
                        placeholder="Select Specific Month/Year" id="datepicker" style="width: fit-content;">
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('transcations.create', ['current_month'=>request()->get('current_month')]) }}">
                        Add New
                    </a>
                    
                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Import/Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('transcations.csv_sample') }}">Download Sample</a>
                            <a class="dropdown-item" href="{{ route('transcations.export') }}">Export</a>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal" style="margin-right: 13px;">
                                Import
                                </button>
                        </div>
                    </div>
                    <a class="btn btn-secondary pull-right" style="margin-right: 10px;"
                    href="{{ route('transcations.index', ['current_month' => $next_month]) }}">Next Month</a>
            
                    <a class="btn btn-secondary pull-right" style=" margin-right: 10px;"
                    href="{{ route('transcations.index', ['current_month' => $previous_month]) }}">Previous Month</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('transcations.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        {!! $transactions->appends(request()->input())->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Transcations</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>
                <form name="importCsvForm" id="importCsvForm" method="POST" action="{{ route('importTranscation') }}" class="js-validate" novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="transcationFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btn_saveimport" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('page_scripts')
    <script type="text/javascript">
         $('#validatedCustomFile').on('change',function(){
            //get the file name
            var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $( "#btn_saveimport" ).click(function() {
            if($("#validatedCustomFile").val() != '')
            {
                $('#importCsvForm').submit();
            }else{
                alert("@lang('Please select a file.')");
            }
            return false;
        });
        $('#datepicker').datetimepicker({
            format: 'MM-YYYY',
        }); 
        $("#datepicker").focusout(function() {
            if ($('#datepicker').val() !== "") {
                window.location.href = window.location.origin + "/transcations?current_month=" + $('#datepicker').val();
            }
        });

    </script>
@endpush

