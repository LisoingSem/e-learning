@extends('mobile_screens.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0 mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <h6 class="border-bottom border-light text-bold pb-2">{{__('lb.Personal Information')}}</h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Khmer Name')}}</label>
                                <h6>{{$worker->name_kh}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Latin Name')}}</label>
                                <h6>{{$worker->name_en}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.National ID Card')}}</label>
                                <h6>{{$worker->id_card}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Gender')}}</label>
                                <h6>{{$worker->sex==1 ? __('lb.Male') : __('lb.Female')}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Date of Birth')}}</label>
                                <h6>{{Carbon\Carbon::parse($worker->dob)->format('d/m/Y')}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Height')}}</label>
                                <h6>{{$worker->height}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Weight')}}</label>
                                <h6>{{$worker->weight}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Religion')}}</label>
                                @if($worker->religion_id)
                                <?php $religion = DB::table('religions')->find($worker->religion_id); ?>
                                <h6>{{$religion->name_kh}} ({{$religion->name_en}})</h6>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Thailand Verification Number')}}</label>
                                <h6>{{$worker->thailand_verification_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Passport')}}</label>
                                <h6>{{$worker->passport_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Travel Letter Number')}}</label>
                                <h6>{{$worker->travel_letter_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Phone Number')}}</label>
                                <h6>{{$worker->phone_number}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Email')}}</label>
                                <h6>{{$worker->email}}</h6>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <h6 class="border-bottom border-light text-bold pb-2">{{__('lb.Place of Birth')}}</h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Village')}}</label>
                                <h6>{{$worker->pob_village}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Commune')}}</label>
                                <h6>{{$worker->pob_commune}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.District')}}</label>
                                <h6>{{$worker->pob_district}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Province')}}</label>
                                <?php  $pob_province = DB::table('pob_provinces')->find($worker->pob_province_id);?>
                                <h6>{{ $pob_province?$pob_province->name_kh.' ('. $pob_province->name_en.')':''}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2">
                                <strong>{{__('lb.Parent Name and Address')}}</strong>
                            </h6>
                        </div>
                        <div class="col-sm-2 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Father Name')}}</label>
                                <h6>{{$parent->father_name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-1col-6 mb-3">
                            <div class="">
                                <label class="text-secondary">{{__('lb.Age')}}</label>
                                <h6>{{$parent->father_age}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-2 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Mother Name')}}</label>
                                <h6>{{$parent->mother_name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-1 col-6 mb-3">
                            <div class="">
                                <label class="text-secondary">{{__('lb.Age')}}</label>
                                <h6>{{$parent->mother_age}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-2 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Home')}}</label>
                                <h6>{{$parent->home_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-2 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Street')}}</label>
                                <h6>{{$parent->street_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-2 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Group')}}</label>
                                <h6>{{$parent->group_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Village')}}</label>
                                <h6>{{$parent->village_kh}} ({{$parent->village_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Commune')}}</label>
                                <h6>{{$parent->commune_kh}} ({{$parent->commune_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.District')}}</label>
                                <h6>{{$parent->district_kh}} ({{$parent->district_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Province')}}</label>
                                <h6>{{$parent->province_kh}} ({{$parent->province_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Phone Number')}}</label>
                                <h6>{{$parent->phone_number}}</h6>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2">
                                <strong>{{__('lb.Spouse Name and Address')}}</strong>
                            </h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Spouse Name')}}</label>
                                <h6>{{$spouse->name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Home')}}</label>
                                <h6>{{$spouse->home_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Street')}}</label>
                                <h6>{{$spouse->street_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Group')}}</label>
                                <h6>{{$spouse->group_no}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Village')}}</label>
                                <h6>{{$spouse->village_kh}} ({{$spouse->village_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Commune')}}</label>
                                <h6>{{$spouse->commune_kh}} ({{$spouse->commune_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.District')}}</label>
                                <h6>{{$spouse->district_kh}} ({{$spouse->district_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Province')}}</label>
                                <h6>{{$spouse->province_kh}} ({{$spouse->province_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Emergency Contact')}}</strong>
                            </h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Name')}}</label>
                                <h6>{{$worker->emergency_name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Relationship')}}</label>
                                <h6>{{$worker->emergency_relationship}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Phone Number')}}</label>
                                <h6>{{$worker->emergency_contact}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Address')}}</label>
                                <h6>{{$worker->emergency_address}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.General Culture')}}</strong></h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.General Culture')}}</label>
                                <h6>{{$worker->degree_kh}} ({{$worker->degree_en}})</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Professional skills')}}</strong>
                            </h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Major')}}</label>
                                <h6>{{$worker->profesional_skill_name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Level')}}</label>
                                <h6>{{$worker->profesional_skill_level}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Faculty')}}</strong></h6>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Major')}}</label>
                                <h6>{{$worker->faculty_skill_name}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Level')}}</label>
                                <h6>{{$worker->faculty_skill_level}}</h6>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Languages')}}</strong></h6>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Language')}}</label><br>
                                @foreach($languages as $lang)
                                <span>{{$lang->name_kh}} &nbsp;&nbsp;</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Driving License')}}</strong></h6>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="border-left pl-2">
                                <label class="text-secondary">{{__('lb.Driving License')}}</label>
                                <h6>{{($worker->is_driver_licence==1) ? __('lb.Have') : __('lb.Do not have')}}</h6>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12">
                        <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Picture and Video')}}</strong></h6>
                    </div>
                    @foreach($documents as $doc)
                    @if($doc->type == 'image')
                    <div class="col-sm-2">
                        <img src="{{asset('documents/'.$doc->path)}}" alt="No file" class="w-100">
                    </div>
                    @endif
                    @if($doc->type == 'file')
                    <div class="col-sm-2">
                        <a href="{{asset('documents/'.$doc->path)}}" alt="No file" class="w-100" download>Download<a>
                    </div>
                    @endif
                    @if($doc->type == 'video')
                    <div class="col-sm-4">
                        <iframe width="100%" height="100" src="https://www.youtube.com/embed/{{$doc->path}}"></iframe>
                    </div>
                    @endif
                    @endforeach -->

                        <div class="col-sm-12">
                            <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Job Information')}}</strong></h6>
                        </div>
                        @foreach($factories as $k => $factory)
                        <div class="col-sm-12 mb-1 px-4">
                            <div class="row bg-light rounded">
                                <div class="col-sm-12">
                                    <h6 class="border-bottom text-bold pb-2"><strong>@if($k){{$k+1}}.@endif
                                        {{__('lb.Company')}}</strong></h6>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Employer')}}</label>
                                        <h6>{{$factory->employer_name}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Address')}}</label>
                                        <h6>{{$factory->address}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Phone Number')}}</label>
                                        <h6>{{$factory->phone_number}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Email')}}</label>
                                        <h6>{{$factory->email}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Sector')}}</label>
                                        <h6>{{$factory->sector_kh}} ({{$factory->sector_en}})</h6>
                                    </div>
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Overseas Contact Address')}}</label>
                                        <h6>{{$factory->oversea_address}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h6 class="border-bottom text-bold pb-2"><strong>{{__('lb.Contract')}}</strong></h6>
                                </div>
                                <div class="col-sm-3 col-6 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Start Date')}}</label>
                                        <h6>{{$factory->start_date}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-6 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.End Date')}}</label>
                                        <h6>{{$factory->end_date}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Contract length')}}
                                            ({{__('lb.In Months')}})</label>
                                        <h6>{{$factory->contract_length}}</h6>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="border-left pl-2">
                                        <label class="text-secondary">{{__('lb.Able to renew the contract')}}</label>
                                        <h6>{{$factory->is_countinue== 1 ? __('lb.Yes') : __('lb.No')}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection