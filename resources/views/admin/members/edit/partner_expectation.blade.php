<div class="card-header bg-dark text-white">
    <h5 class="mb-0 h6">{{translate('Partner Expectation')}}</h5>
</div>
<div class="card-body">
    <form action="{{ route('partner_expectations.update', $member->id) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <div class="form-group row">
            <div class="col-md-6">
                <label for="general">{{translate('General')}}</label>
                <input type="text" name="general" value="{{ !empty($member->partner_expectations->general) ? $member->partner_expectations->general : "" }}" class="form-control" placeholder="{{translate('General')}}" required>
            </div>
            <div class="col-md-6">
                <label for="residence_country_id">{{translate('Residence Country')}}</label>
                @php $partner_residence_country = !empty($member->partner_expectations->residence_country_id) ? $member->partner_expectations->residence_country_id : ""; @endphp
                <select class="form-control aiz-selectpicker" name="residence_country_id" data-live-search="true" required>

                    @foreach ($countries as $country)
                        <option value="{{$country->id}}" @if($country->id == $partner_residence_country) selected @endif >{{$country->name}}</option>
                    @endforeach
                </select>
                @error('residence_country_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_height">{{translate('Height')}}</label>
                <input type="number" name="partner_height" value="{{ !empty($member->partner_expectations->height) ? $member->partner_expectations->height : "" }}" step="any"  placeholder="{{ translate('Height') }}" class="form-control" required>
                @error('partner_height')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="partner_weight">{{translate('Weight')}}</label>
                <input type="number" name="partner_weight" value="{{ !empty($member->partner_expectations->weight) ? $member->partner_expectations->weight : "" }}" step="any"  class="form-control" placeholder="{{translate('Weight')}}" required>
                @error('partner_weight')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_marital_status">{{translate('Marital Status')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_marital_status" data-live-search="true" required>
                    @foreach ($marital_statuses as $marital_status)
                        <option value="{{$marital_status->id}}" @if($member->member->marital_status_id == $marital_status->id) selected @endif>{{$marital_status->name}}</option>
                    @endforeach
                </select>
                @error('partner_marital_status')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="partner_children_acceptable">{{translate('Children Acceptable')}}</label>
                <input type="text" name="partner_children_acceptable" value="{{ !empty($member->partner_expectations->children_acceptable) ? $member->partner_expectations->children_acceptable : "" }}" class="form-control" placeholder="{{translate('Children Acceptable')}}" required>
                @error('partner_children_acceptable')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_religion_id">{{translate('Religion')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_religion_id" id="partner_religion_id" data-live-search="true" required>
                    <option value="">{{translate('Select One')}}</option>
                    @foreach ($religions as $religion)
                        <option value="{{$religion->id}}" @if($religion->id == $partner_religion_id) selected @endif> {{ $religion->name }} </option>
                    @endforeach
                </select>
                @error('partner_religion_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="partner_caste_id">{{translate('Caste')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_caste_id" id="partner_caste_id" data-live-search="true" required>

                </select>
                @error('partner_caste_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_sub_caste_id">{{translate('Sub Caste')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_sub_caste_id" id="partner_sub_caste_id" data-live-search="true">

                </select>
            </div>
            <div class="col-md-6">
                <label for="language_id">{{translate('Language')}}</label>
                <select class="form-control aiz-selectpicker" name="language_id" data-live-search="true">
                    <option value="">{{translate('Select One')}}</option>
                    @foreach ($languages as $language)
                        <option value="{{$language->id}}" @if($language->id == (!empty($member->partner_expectations->language_id) ? $member->partner_expectations->language_id : "")) selected @endif> {{ $language->name }} </option>
                    @endforeach
                </select>
                @error('language_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="pertner_education">{{translate('Education')}}</label>
                <input type="text" name="pertner_education" value="{{ !empty($member->partner_expectations->education) ? $member->partner_expectations->education : "" }}" class="form-control" placeholder="{{translate('Education')}}" required>
                @error('pertner_education')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="partner_profession">{{translate('Profession')}}</label>
                <input type="text" name="partner_profession" value="{{ !empty($member->partner_expectations->profession) ? $member->partner_expectations->profession : "" }}" class="form-control" placeholder="{{translate('Profession')}}" required>
                @error('partner_profession')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="smoking_acceptable">{{translate('Smoking Acceptable')}}</label>
                <input type="text" name="smoking_acceptable" value="{{ !empty($member->partner_expectations->smoking_acceptable) ? $member->partner_expectations->smoking_acceptable : "" }}" class="form-control" placeholder="{{translate('Smoking Acceptable')}}" required>
                @error('smoking_acceptable')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="drinking_acceptable">{{translate('Drinking Acceptable')}}</label>
                <input type="text" name="drinking_acceptable" value="{{ !empty($member->partner_expectations->drinking_acceptable) ? $member->partner_expectations->drinking_acceptable : "" }}" class="form-control" placeholder="{{translate('Drinking Acceptable')}}" required>
                @error('drinking_acceptable')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_diet">{{translate('Diet')}}</label>
                <input type="text" name="partner_diet" value="{{ !empty($member->partner_expectations->diet) ? $member->partner_expectations->diet : "" }}" class="form-control" placeholder="{{translate('Diet')}}" required>
                @error('partner_diet')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="partner_body_type">{{translate('Body Type')}}</label>
                <input type="text" name="partner_body_type" value="{{ !empty($member->partner_expectations->body_type) ? $member->partner_expectations->body_type : "" }}" class="form-control" placeholder="{{translate('Body Type')}}" required>
                @error('partner_body_type')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_personal_value">{{translate('Personal Value')}}</label>
                <input type="text" name="partner_personal_value" value="{{ !empty($member->partner_expectations->personal_value) ? $member->partner_expectations->personal_value : "" }}" class="form-control" placeholder="{{translate('Personal Value')}}" required>
                @error('partner_personal_value')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="partner_manglik">{{translate('Manglik')}}</label>
                <input type="text" name="partner_manglik" value="{{ !empty($member->partner_expectations->manglik) ? $member->partner_expectations->manglik : "" }}" class="form-control" placeholder="{{translate('Manglik')}}" required>
                @error('partner_manglik')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="partner_country_id">{{translate('Preferred Country')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_country_id" id="partner_country_id" data-live-search="true" required>
                    <option value="">{{translate('Select One')}}</option>
                    @foreach ($countries as $country)
                        <option value="{{$country->id}}" @if($country->id == $partner_country_id) selected @endif>{{$country->name}}</option>
                    @endforeach
                </select>
                @error('partner_country_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="partner_state_id">{{translate('Preferred State')}}</label>
                <select class="form-control aiz-selectpicker" name="partner_state_id" id="partner_state_id" data-live-search="true" required>

                </select>
                @error('partner_state_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="family_value_id">{{translate('Family Value')}}</label>
                <select class="form-control aiz-selectpicker" name="family_value_id" data-live-search="true" >
                    <option value="">{{translate('Select One')}}</option>
                    @foreach ($family_values as $family_value)
                        <option value="{{$family_value->id}}" @if($family_value->id == !empty($member->partner_expectations->family_value_id) ? $member->partner_expectations->family_value_id : "") selected @endif> {{ $family_value->name }} </option>
                    @endforeach
                </select>
                @error('family_value_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="pertner_complexion">{{translate('Complexion')}}</label>
                <input type="text" name="pertner_complexion" value="{{ !empty($member->partner_expectations->complexion) ? $member->partner_expectations->complexion : "" }}" class="form-control" placeholder="{{translate('Complexion')}}" required>
                @error('pertner_complexion')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
        </div>
    </form>
</div>
