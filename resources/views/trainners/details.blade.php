<!-- Modal Create -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form id="form_create" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Trainner Details</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <div class="col-sm-12 mb-3">
                            <label style="cursor: pointer; border: 1px dashed gray; height: 230px;"
                                class="col-12 d-flex align-content-center justify-content-center p-0 m-0 bg-black rounded-circle overflow-hidden">
                                <img id="dthumbnail_logo" src="{{asset('img/avatar-placeholder.jpg')}}" class="m-auto"
                                    style="height: 100%; width: 100%; object-fit: cover;" onerror="(this).src='{{ asset('img/avatar-placeholder.jpg') }}'">
                            </label>
                        </div>
                        <div class="col-sm-12 m-auto">
                            <input id="dname"
                                class="form-control border-0 bg-transparent p-0 font-weight-bold text-center"
                                style="margin-top: -5px; font-size: 20px" readonly>

                            <div class="d-flex align-items-center-center justify-content-center mt-1" style="gap: 10px">
                                <label class="m-0 font-weight-light">Gender :</label>
                                <span id="dgender" class="font-weight-bold text-center">hsdfs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <h4 class="pl-2 text-info mb-3">Information Details</h4>
                        <div class="col-sm-12 mb-2">
                            <label class="m-0 font-weight-light">Email</label>
                            <input id="demail" class="form-control border-0 bg-transparent p-0 font-weight-bold"
                                style="margin-top: -5px" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label class="m-0 font-weight-light">Phone Number</label>
                            <input id="dphone_number" class="form-control border-0 bg-transparent p-0 font-weight-bold"
                                style="margin-top: -5px" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label class="m-0 font-weight-light">Expericence</label>
                            <input id="dyear_experience"
                                class="form-control border-0 bg-transparent p-0 font-weight-bold"
                                style="margin-top: -5px" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label class="m-0 font-weight-light">Skills</label>
                            <input id="dskills" class="form-control border-0 bg-transparent p-0 font-weight-bold"
                                style="margin-top: -5px" readonly>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label class="m-0 font-weight-light">Description</label>
                            <p id="ddescription" class="text-wrap text-break font-weight-bold" style="color: #495057;">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Course Teaching:</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead class="table-active">
                                <tr>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Name English</th>
                                    <th class="text-center">Name Khmer</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total Hours</th>
                                </tr>
                            </thead>
                            <tbody id="tableDeatail"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    {{__('lb.Close')}}</button>
            </div>
        </form>
    </div>
</div>
