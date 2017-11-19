@extends('layout.main')

@section('title', "Algorism Property: Add")

@section('nav')
    <a href="{{ url('/') }}" class="btn btn-primary btn-block"><i class="fa fa-chevron-left"></i> Back</a>
@stop

@section('customscript')
    <script>
        $(document).ready(function () {
            $('#dataform').submit(function (e) {
                e.preventDefault();
                $('#savedata').html('Adding...');

                $.ajax({
                    url: "{{ url('/api/addproperty') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#dataform').trigger("reset");
                        $('#savedata').html('Add Property');
                        if(data == "success"){
                            swal(
                                'Success!',
                                'The Property was added!',
                                'success'
                            )
                        }
                        else{
                            swal(
                                'Oops...',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    },
                    error: function (error) {
                        $('#savedata').html('Add Property');
                        swal(
                            'Oops...',
                            'Something went wrong!',
                            'error'
                        )
                    }
                });
            });
        })
    </script>
@endsection

@section('content')

    <div>
        <div class="card" style="margin-bottom: 60px">
            <div class="card-header">
                Add Property
            </div>
            <div class="card-body">
               <div class="row">
                   <div class="col-md-8 offset-md-2">
                       <form method="post" enctype="multipart/form-data" id="dataform">
                           <div class="form-group">
                               <label>Property Title <small style="color: red">*</small> </label>
                               <input type="text" class="form-control" name="ptitle" placeholder="title" required>
                           </div>
                           <div class="form-group">
                               <label>Property Location <small style="color: red">*</small></label>
                               <input type="text" class="form-control" name="plocation" placeholder="location address" required>
                           </div>
                           <div class="form-group">
                               <label>City <small style="color: red">*</small></label>
                               <input type="text" class="form-control" name="pcity" placeholder="City" required>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Bedrooms</label>
                                       <input type="number" class="form-control" name="pbedroom" placeholder="Number of Bedrooms">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Bathrooms</label>
                                       <input type="number" class="form-control" name="pbathroom" placeholder="Number of Bathrooms">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Toilets</label>
                                       <input type="number" class="form-control" name="ptoilet" placeholder="Number of toilets">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Property Type <small style="color: red">*</small></label>
                                       <select class="form-control" name="ptype" required>
                                           <option value="">Choose...</option>
                                           <option value="flat">Flat</option>
                                           <option value="Duplex">Duplex</option>
                                           <option value="Sky scrapper">Sky scrapper</option>
                                           <option value="Bungalow">Bungalow</option>
                                           <option value="Estate">Estate</option>
                                       </select>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Property Price <small style="color: red">*</small></label>
                                       <input type="number" class="form-control" name="pPrice" placeholder="Price" required>
                                   </div>
                               </div>

                           </div>

                           <div class="form-group">
                               <label >About Property <small style="color: red">*</small></label>
                               <textarea required class="form-control" name="pdetail" rows="3" placeholder="Give a detailed review of the property"></textarea>
                           </div>

                           <button id="savedata" class="btn btn-primary" type="submit">Add Property</button>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>

@endsection